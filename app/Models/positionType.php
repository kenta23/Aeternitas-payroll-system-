<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class positionType extends Model
{
    use HasFactory;
    protected $table ='position_types';
    protected $fillable = [
         'position'
    ];

}
