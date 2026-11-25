<?php

namespace App\Domain\Audit;

use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Context;
use Illuminate\Support\Str;

class Audit
{
    private const SENSITIVE = ['password', 'token', 'secret'];

    /**
     * Mencatat satu kejadian. Ikut transaksi pemanggil: bila transaksi batal, catatan ikut batal.
     *
     * @param  Model|array{type: string, id?: int|string|null, label?: string|null}  $subject
     * @param  array<string, mixed>|null  $before
     * @param  array<string, mixed>|null  $after
     */
    public static function record(string $action, Model|array $subject, ?array $before = null, ?array $after = null, ?string $reason = null): AuditLog
    {
        $user = Auth::user();

        if ($subject instanceof Model) {
            $subject = [
                'type' => $subject->getMorphClass(),
                'id' => $subject->getKey(),
                'label' => $subject->getAttribute('name') ?? $subject->getKey(),
            ];
        }

        if ($before !== null && $after !== null) {
            $changed = array_flip(array_filter(
                array_keys($before + $after),
                fn (string $key) => json_encode($before[$key] ?? null) !== json_encode($after[$key] ?? null),
            ));
            $before = array_intersect_key($before, $changed);
            $after = array_intersect_key($after, $changed);
        }

        return AuditLog::query()->create([
            'occurred_at' => now(),
            'actor_type' => $user instanceof User ? 'user' : 'system',
            'actor_id' => $user?->id,
            'actor_role' => $user instanceof User ? $user->role->value : null,
            'action' => $action,
            'subject_type' => $subject['type'],
            'subject_id' => $subject['id'] ?? null,
            'subject_label' => Str::limit((string) ($subject['label'] ?? ''), 250) ?: null,
            'before' => self::mask($before),
            'after' => self::mask($after),
            'reason' => $reason,
            'ip' => request()->ip(),
            'user_agent' => Str::limit((string) request()->userAgent(), 500, '') ?: null,
            'request_id' => Context::get('request_id'),
        ]);
    }

    /**
     * @param  array<string, mixed>|null  $data
     * @return array<string, mixed>|null
     */
    private static function mask(?array $data): ?array
    {
        if ($data === null) {
            return null;
        }

        foreach ($data as $key => $value) {
            if (Str::contains(mb_strtolower((string) $key), self::SENSITIVE)) {
                $data[$key] = '***';
            } elseif (is_array($value)) {
                $data[$key] = self::mask($value);
            }
        }

        return $data;
    }
}
