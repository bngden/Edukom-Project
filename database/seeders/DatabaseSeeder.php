<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use RuntimeException;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Parameter kebijakan dan komponen honor (semua environment); akun bawaan Owner/Admin dan contoh alasan
     * penolakan (hanya APP_ENV=local; kata sandi dari SEED_OWNER_PASSWORD / SEED_ADMIN_PASSWORD).
     */
    public function run(): void
    {
        $this->call([PolicyParameterSeeder::class, HonorComponentSeeder::class]);

        if (! app()->environment('local')) {
            $this->command?->warn('DatabaseSeeder dilewati: hanya berjalan di APP_ENV=local.');

            return;
        }

        $accounts = [
            ['email' => 'owner@edukom.test', 'name' => 'Owner Edukom', 'role' => Role::Owner, 'password' => config('edukom.seed.owner_password'), 'env' => 'SEED_OWNER_PASSWORD'],
            ['email' => 'admin@edukom.test', 'name' => 'Admin Edukom', 'role' => Role::Admin, 'password' => config('edukom.seed.admin_password'), 'env' => 'SEED_ADMIN_PASSWORD'],
        ];

        foreach ($accounts as $account) {
            if (blank($account['password']) || mb_strlen((string) $account['password']) < 8) {
                throw new RuntimeException("{$account['env']} di .env wajib diisi (minimal 8 karakter).");
            }

            User::query()->updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'role' => $account['role'],
                    'password' => $account['password'],
                    'is_active' => true,
                ],
            );
        }

        $this->call(LeaveRejectionReasonSeeder::class);
    }
}
