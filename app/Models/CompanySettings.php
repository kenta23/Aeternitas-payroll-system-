<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_name',
        'contact_person',
        'address',
        'country',
        'city',
        'state_province',
        'postal_code',
        'email',
        'mobile_number',
        'website_url',
    ];
}
