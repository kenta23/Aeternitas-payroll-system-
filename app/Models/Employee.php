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
        'email',
        'birth_date',
        'gender',
        'employee_id',
        'position',
        'department_id',
        'phone_number',
        'current_address',
        'pay type',
        'per_day',
        'basic_pay',
        'per_month',
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
        'seperation_date',
        'seperation_reason',
        'seperation_remarks',
        'created_at',
        'updated_at',
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
