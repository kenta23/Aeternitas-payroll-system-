<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a company setting
        DB::table('company_settings')->insert([
            'company_name' => 'Aeternitas',
            'contact_person' => 'Dr. Rolan S. Visca',
            'address' => 'Blk. 44 Lot 5 & 6, Commonwealth Ave. Brgy. Batasan Hills, Quezon City, Metro Manila, Philippines',
            'country' => 'Philippines',
            'city' => 'Quezon City',
            'state_province' => 'Metro Manila',
            'postal_code' => '1121',
            'email' => 'Info@aeternitas.ph',
            'mobile_number' => '0917 180 2427',
            'website_url' => 'https://aeternitas.ph/',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
}

