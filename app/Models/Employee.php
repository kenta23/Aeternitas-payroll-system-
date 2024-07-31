<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'suffix',
        'email',
        'birth_date',
        'gender',
        'employee_id',
        'position',
        'department_id',
        'phone_number',
        'current_address',
        'pay_type',
        'per_day',
        'basic_pay',
        'allowance',
        'monthly_pay',
        'bi_monthly',
        'actual_days_worked',
        'absences',
        'vlsl',
        'regular_worked_days',
        'rwd_amount',
        'legal_worked_days',
        'lhd_amount',
        'leave_amount',
        'special_rate',
        'special_worked_days',
        'special_amount',
        'total_basic_pay',
        'total_basic_pay_plus_ot',
        'gross_pay',
        'ot_rate25',
        'ot_hours25',
        'ot_amount25',
        'ot_rate30',
        'ot_hours30',
        'ot_amount30',
        'ot_rate100',
        'ot_hours100',
        'ot_amount100',
        'total_ot',
        'nd_rate',
        'nd_hours',
        'nd_amount',
        'late_rate',
        'number_of_minutes_late',
        'late_amount',
        'missing_charges',
        'total_charges',
        'half_allowance',
        'meal_allowance',
        'sss_number',
        'philhealth_number',
        'pagibig_number',
        'tin_number',
        'monthly_compensation',
        'number_dependents',
        'name_dependents',
        'emergency_name',
        'emergency_phonenumber',
        'emergency_relationship',
        'emergency_address',
        'separation_date',
        'separation_reason',
        'separation_remarks',
    ];

    public function attendances()
    {
        return $this->hasMany(AttendanceModel::class);
    }

    public function department()
    {
        return $this->belongsTo(department::class);
    }
}
