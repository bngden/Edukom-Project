<?php

namespace Database\Factories;

use App\Enums\PayrollPeriodStatus;
use App\Models\PayrollPeriod;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<PayrollPeriod>
 */
class PayrollPeriodFactory extends Factory
{
    public function definition(): array
    {
        return $this->attributesFor(now()->year, now()->month);
    }

    /**
     * @return array<string, mixed>
     */
    private function attributesFor(int $year, int $month): array
    {
        $start = Carbon::create($year, $month, 1);

        return [
            'year' => $year,
            'month' => $month,
            'starts_on' => $start->toDateString(),
            'ends_on' => $start->endOfMonth()->toDateString(),
            'status' => PayrollPeriodStatus::Open,
        ];
    }

    public function month(int $year, int $month): static
    {
        return $this->state($this->attributesFor($year, $month));
    }

    public function closed(): static
    {
        return $this->state(['status' => PayrollPeriodStatus::Closed]);
    }

    public function approved(): static
    {
        return $this->state(['status' => PayrollPeriodStatus::Approved]);
    }
}
