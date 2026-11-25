<?php

namespace App\Http\Middleware;

use App\Enums\Role;
use App\Models\User;
use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;

/**
 * Pemakaian: ->middleware('role:owner,admin'). Pasang setelah auth:sanctum.
 */
class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if ($roles === []) {
            throw new InvalidArgumentException('Middleware role membutuhkan minimal satu peran.');
        }

        $allowed = array_map(
            static fn (string $role): Role => Role::tryFrom(trim($role))
                ?? throw new InvalidArgumentException("Peran \"{$role}\" tidak dikenal pada middleware role."),
            $roles,
        );

        $user = $request->user();

        if (! $user instanceof User) {
            throw new AuthenticationException;
        }

        if (! in_array($user->role, $allowed, true)) {
            throw new AuthorizationException;
        }

        return $next($request);
    }
}
