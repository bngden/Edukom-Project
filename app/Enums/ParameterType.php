<?php

namespace App\Enums;

enum ParameterType: string
{
    case Integer = 'integer';
    case Time = 'time';
    case RelativeDeadline = 'relative_deadline';
    case ByLeaveType = 'by_leave_type';
    case Escalation = 'escalation';
    case ServiceHours = 'service_hours';
    case ReuploadLimit = 'reupload_limit';
    case FileRule = 'file_rule';

    private const DAYS = [1 => 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    /**
     * Aturan validasi untuk field `value` (dan isinya).
     *
     * @return array<string, list<string>>
     */
    public function rules(int $min = 1, int $max = 1000): array
    {
        $int = fn (int $from, int $to) => ['required', 'integer:strict', "between:{$from},{$to}"];
        $time = ['required', 'date_format:H:i'];
        $deadline = fn (string $field) => [
            $field => ['required', 'array:days_before,time'],
            "{$field}.days_before" => $int(0, 60),
            "{$field}.time" => $time,
        ];

        return match ($this) {
            self::Integer => ['value' => $int($min, $max)],
            self::Time => ['value' => $time],
            self::RelativeDeadline => $deadline('value'),
            self::ByLeaveType => [
                'value' => ['required', 'array:planned,urgent'],
                'value.planned' => $int(1, 720),
                'value.urgent' => $int(1, 720),
            ],
            self::Escalation => [
                'value' => ['required', 'array:planned,urgent_hours_before'],
                ...$deadline('value.planned'),
                'value.urgent_hours_before' => $int(1, 720),
            ],
            self::ServiceHours => [
                'value' => ['required', 'array:days,start,end'],
                'value.days' => ['required', 'array', 'min:1'],
                'value.days.*' => ['integer:strict', 'between:1,7', 'distinct'],
                'value.start' => $time,
                'value.end' => [...$time, 'after:value.start'],
            ],
            self::ReuploadLimit => [
                'value' => ['required', 'array:max_times,within_days'],
                'value.max_times' => $int(1, 100),
                'value.within_days' => $int(1, 365),
            ],
            self::FileRule => [
                'value' => ['required', 'array:extensions,max_size_mb,max_files'],
                'value.extensions' => ['required', 'array', 'min:1'],
                'value.extensions.*' => ['string', 'in:jpg,jpeg,png,pdf', 'distinct'],
                'value.max_size_mb' => $int(1, 20),
                'value.max_files' => $int(1, 10),
            ],
        };
    }

    /**
     * Teks Indonesia siap tampil, misalnya "H-3 pukul 23.59 WIB" atau "70 menit".
     */
    public function display(mixed $value, ?string $unit = null): string
    {
        $time = fn (string $t) => str_replace(':', '.', $t);
        $deadline = fn (array $d) => "H-{$d['days_before']} pukul {$time($d['time'])} WIB";

        return match ($this) {
            self::Integer => trim("{$value} {$unit}"),
            self::Time => $time($value).' WIB',
            self::RelativeDeadline => $deadline($value),
            self::ByLeaveType => "Terencana {$value['planned']} jam · Mendesak {$value['urgent']} jam",
            self::Escalation => 'Terencana '.$deadline($value['planned'])." · Mendesak {$value['urgent_hours_before']} jam sebelum mulai",
            self::ServiceHours => self::days($value['days'])." {$time($value['start'])}–{$time($value['end'])}",
            self::ReuploadLimit => "Maks {$value['max_times']} kali dalam {$value['within_days']} hari",
            self::FileRule => implode(', ', $value['extensions'])." · maks {$value['max_size_mb']} MB · {$value['max_files']} berkas",
        };
    }

    /**
     * @param  list<int>  $days
     */
    private static function days(array $days): string
    {
        sort($days);
        $consecutive = count($days) > 2 && end($days) - $days[0] === count($days) - 1;

        return $consecutive
            ? self::DAYS[$days[0]].'–'.self::DAYS[end($days)]
            : implode(', ', array_map(fn (int $d) => self::DAYS[$d], $days));
    }
}
