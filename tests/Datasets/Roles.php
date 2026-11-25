<?php

use App\Enums\Role;

dataset('all_roles', fn () => rolesExcept());

dataset('all_roles_except_owner', fn () => rolesExcept(Role::Owner));

dataset('all_roles_except_owner_admin', fn () => rolesExcept(Role::Owner, Role::Admin));
