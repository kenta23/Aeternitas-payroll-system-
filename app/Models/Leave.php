<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;
    protected $table = 'leave_employees';

    protected $fillable = [
        'total_credit_points',
        'total_used_vlsl',
        'credits_vl',
        'used_vl',
        'balance_vl',
        'credits_sl',
        'used_sl',
        'balance_sl'
    ];


    public function employee (): BelongsTo {
        return $this->belongsTo(Employee::class);
    }
}
