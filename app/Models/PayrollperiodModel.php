<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollperiodModel extends Model
{
    use HasFactory;

    protected $table ='payrollperiod';

    protected $fillable = [
        'startpayrollperiod',
        'endpayrollperiod',
    ];
}
