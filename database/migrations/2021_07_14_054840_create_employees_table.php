<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('email');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('employee_id')->nullable();
            $table->string('position');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('phone_number')->nullable();
            $table->mediumText('current_address')->nullable();
            $table->string('pay_type')->nullable(); // Corrected line
            $table->decimal('per_day', 10, 2)->nullable();
            $table->decimal('basic_pay', 10, 2)->nullable();
            $table->decimal('allowance', 10, 2)->nullable();
            $table->decimal('monthly_pay', 10, 2)->nullable();
            $table->decimal('bi_monthly', 10, 2)->nullable();
            $table->integer('actual_days_worked')->nullable();
            $table->decimal('absences', 10, 2)->nullable();
            $table->decimal('vlsl', 10, 2)->nullable();
            $table->decimal('regular_worked_days', 10, 2)->nullable();
            $table->decimal('rwd_amount', 10, 2)->nullable();
            $table->decimal('legal_worked_days', 10, 2)->nullable();
            $table->decimal('lhd_amount', 10, 2)->nullable();
            $table->decimal('leave_amount', 10, 2)->nullable();
            $table->decimal('special_rate', 10, 2)->nullable();
            $table->decimal('special_worked_days', 10, 2)->nullable();
            $table->decimal('special_amount', 10, 2)->nullable();
            $table->decimal('total_basic_pay', 10, 2)->nullable();
            $table->decimal('total_monthly', 10, 2)->nullable();
            $table->string('sss_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->string('tin_number')->nullable();
            $table->integer('monthly_compensation')->nullable();
            $table->integer('number_dependents')->nullable();
            $table->string('name_dependents')->nullable();

            // Emergency contact
            $table->string('emergency_name');
            $table->string('emergency_phonenumber')->nullable();
            $table->string('emergency_relationship');
            $table->mediumText('emergency_address');

            // Separation
            $table->timestamp('separation_date')->nullable();
            $table->mediumText('separation_reason')->nullable();
            $table->mediumText('separation_remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
}
