<?php

use App\Enums\Role;

it('memberi label Indonesia untuk setiap peran', function () {
    expect(array_map(fn (Role $role) => $role->label(), Role::cases()))
        ->toBe(['Owner', 'Admin', 'Tentor', 'Kurir', 'Teknisi'])
        ->and(Role::values())->toBe(['owner', 'admin', 'tentor', 'kurir', 'teknisi']);
});
