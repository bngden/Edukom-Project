<?php

namespace App\Console\Commands;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateUser extends Command
{
    protected $signature = 'edukom:create-user
        {role : owner, admin, tentor, kurir, atau teknisi}
        {email : Email akun}
        {name : Nama lengkap}';

    protected $description = 'Membuat akun pengguna baru (kata sandi diminta secara interaktif)';

    public function handle(): int
    {
        $data = [
            'role' => mb_strtolower((string) $this->argument('role')),
            'email' => mb_strtolower(trim((string) $this->argument('email'))),
            'name' => trim((string) $this->argument('name')),
        ];

        $validator = Validator::make($data, [
            'role' => ['required', Rule::enum(Role::class)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'name' => ['required', 'string', 'max:255'],
        ], [], ['role' => 'peran', 'name' => 'nama']);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->error($message);
            }

            return self::FAILURE;
        }

        $password = (string) $this->secret('Kata sandi (minimal 8 karakter)');
        $confirmation = (string) $this->secret('Ulangi kata sandi');

        $passwordValidator = Validator::make(
            ['password' => $password, 'password_confirmation' => $confirmation],
            ['password' => ['required', 'confirmed', Password::min(8)]],
            [],
            ['password' => 'kata sandi'],
        );

        if ($passwordValidator->fails()) {
            foreach ($passwordValidator->errors()->all() as $message) {
                $this->error($message);
            }

            return self::FAILURE;
        }

        $user = User::query()->create([
            ...$data,
            'password' => $password,
            'is_active' => true,
        ]);

        $this->info("Akun {$user->role->label()} {$user->email} berhasil dibuat (id {$user->id}).");

        return self::SUCCESS;
    }
}
