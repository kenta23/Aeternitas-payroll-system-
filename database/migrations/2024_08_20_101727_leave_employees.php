<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('leave_employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->decimal('total_credit_points', 8, 2)->default(0);
            $table->decimal('total_used_vlsl', 8, 2)->default(0);
            $table->decimal('credits_vl', 8, 2)->default(0);
            $table->decimal('used_vl', 8, 2)->default(0);
            $table->decimal('balance_vl', 8, 2)->default(0);
            $table->decimal('credits_sl', 8, 2)->default(0);
            $table->decimal('used_sl', 8, 2)->default(0);
            $table->decimal('balance_sl', 8, 2)->default(0);


            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_employees');
    }
};
