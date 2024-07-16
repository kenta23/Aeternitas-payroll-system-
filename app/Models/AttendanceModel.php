<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceModel extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $fillable = [
         'name',
         'employee_id',
         'time_in',
         'time_out',
         'overtime',
    ];


    public function employee()  {
        return $this->belongsTo(Employee::class);
    }
}
