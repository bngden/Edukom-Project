<?php

use App\Enums\Role;

it('rolesExcept menghasilkan semua peran kecuali yang diizinkan', function () {
    expect(array_keys(rolesExcept()))->toBe(Role::values())
        ->and(array_keys(rolesExcept(Role::Owner, Role::Admin)))->toBe(['tentor', 'kurir', 'teknisi'])
        ->and(rolesExcept(Role::Owner)['admin'])->toBe([Role::Admin]);
});
