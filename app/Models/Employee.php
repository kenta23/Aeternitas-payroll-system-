<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = [
        'first_name',
        'last_name',
        'suffix',
        'sex',
        'age',
        'email',
        'birth_date',
        'employee_id',
        'position',
        'department_id',
        'phone_number',
        'current_address',
        'pay_type',
        'per_day',
        'per_month',
        'basic_pay',
        'allowance',
        'monthly_pay',
        'bi_monthly',
        'actual_days_worked',
        'start_date_payroll',
        'end_date_payroll',
        'absences',
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
        'sss_premcontribution',
        'sss_wisp',
        'phic',
        'hdmf',
        'tax',
        'sss_loan',
        'hdmf_loan',
        'employee_purchase',
        'uniform',
        'cash_advance',
        'otherdeduction',
        'employer_sss_premcontribution',
        'employer_sss_wisp',
        'employer_phic',
        'employer_hdmf',
        'tax_sss_premcontribution',
        'tax_sss_wisp',
        'tax_phic',
        'tax_hdmf',
        'totalremittance',
        'taxable_income',
        'tax_cl',
        'tax_excess',
        'tax_rate_percentage',
        'tax_rate',
        'fixed_rate',
        'tax_month',
        'tax_cutoff',
        'total_deduction',
        'netpay',
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


    public function attendances(): HasMany
    {
        return $this->hasMany(AttendanceModel::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(department::class);
    }
    public function leave(): HasOne {
        return $this->hasOne(Leave::class);
    }
}
