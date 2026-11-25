<?php

namespace App\Domain\Notification;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class Recipients
{
    /**
     * @return Collection<int, User>
     */
    public static function owners(): Collection
    {
        return self::active(Role::Owner);
    }

    /**
     * @return Collection<int, User>
     */
    public static function admins(): Collection
    {
        return self::active(Role::Admin);
    }

    /**
     * @return Collection<int, User>
     */
    private static function active(Role $role): Collection
    {
        return User::query()->select(['id', 'name', 'role'])->where('role', $role)->active()->get();
    }
}
