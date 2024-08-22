<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'suffix' => $this->faker->optional()->suffix,
            'sex' => $this->faker->randomElement(['Male', 'Female']),
            'age' => $this->faker->numberBetween(18, 65),
            'email' => $this->faker->unique()->safeEmail(),
            'birth_date' => $this->faker->date(),
            'employee_id' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{4}'),
            'position' => $this->faker->jobTitle(),
            'department_id' => $this->faker->numberBetween(1, 3),
            'phone_number' => $this->faker->phoneNumber(),
            'current_address' => $this->faker->streetAddress(),
            'pay_type' => 'Monthly',
            'per_day' => $this->faker->numberBetween(100, 500),
            'per_month' => $this->faker->numberBetween(5000, 20000),
            'basic_pay' => $this->faker->numberBetween(5000, 20000),
            'allowance' => $this->faker->numberBetween(500, 2000),
            'monthly_pay' => $this->faker->numberBetween(5000, 20000),
            'bi_monthly' => $this->faker->numberBetween(5000, 20000),
            'actual_days_worked' => $this->faker->numberBetween(10, 30),
            'start_date_payroll' => $this->faker->date(),
            'end_date_payroll' => $this->faker->date(),
            'absences' => $this->faker->numberBetween(0, 10),
            'regular_worked_days' => $this->faker->numberBetween(10, 30),
            'rwd_amount' => $this->faker->numberBetween(1000, 5000),
            'legal_worked_days' => $this->faker->numberBetween(0, 10),
            'lhd_amount' => $this->faker->numberBetween(1000, 5000),
            'leave_amount' => $this->faker->numberBetween(1000, 5000),
            'special_rate' => $this->faker->numberBetween(1, 100),
            'special_worked_days' => $this->faker->numberBetween(0, 10),
            'special_amount' => $this->faker->numberBetween(1000, 5000),
            'total_basic_pay' => $this->faker->numberBetween(10000, 50000),
            'total_basic_pay_plus_ot' => $this->faker->numberBetween(10000, 50000),
            'gross_pay' => $this->faker->numberBetween(10000, 50000),
            'ot_rate25' => $this->faker->numberBetween(1, 100),
            'ot_hours25' => $this->faker->numberBetween(1, 10),
            'ot_amount25' => $this->faker->numberBetween(1000, 5000),
            'ot_rate30' => $this->faker->numberBetween(1, 100),
            'ot_hours30' => $this->faker->numberBetween(1, 10),
            'ot_amount30' => $this->faker->numberBetween(1000, 5000),
            'ot_rate100' => $this->faker->numberBetween(1, 100),
            'ot_hours100' => $this->faker->numberBetween(1, 10),
            'ot_amount100' => $this->faker->numberBetween(1000, 5000),
            'total_ot' => $this->faker->numberBetween(1000, 5000),
            'nd_rate' => $this->faker->numberBetween(1, 100),
            'nd_hours' => $this->faker->numberBetween(1, 10),
            'nd_amount' => $this->faker->numberBetween(1000, 5000),
            'late_rate' => $this->faker->numberBetween(1, 100),
            'number_of_minutes_late' => $this->faker->numberBetween(1, 60),
            'late_amount' => $this->faker->numberBetween(1000, 5000),
            'missing_charges' => $this->faker->numberBetween(1000, 5000),
            'total_charges' => $this->faker->numberBetween(1000, 5000),
            'half_allowance' => $this->faker->numberBetween(1000, 5000),

            'emergency_name' => $this->faker->name,
            'emergency_phonenumber' => $this->faker->phoneNumber(),
            'emergency_relationship' => $this->faker->randomElement(['Mother', 'Father', 'Brother', 'Sister', 'Cousin']),
            'emergency_address' => $this->faker->address(),


        ];
    }
}
