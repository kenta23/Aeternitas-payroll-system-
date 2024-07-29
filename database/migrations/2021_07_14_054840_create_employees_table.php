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
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('email');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('employee_id');
            $table->string('position');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('phone_number')->nullable();
            $table->mediumText('current_address')->nullable();
            $table->string('pay_type')->default('monthly'); // Corrected line
            $table->decimal('per_day', 10, 2)->default(0);
            $table->decimal('basic_pay', 10, 2)->default(0);
            $table->decimal('allowance', 10, 2)->default(0);
            $table->decimal('monthly_pay', 10, 2)->default(0);
            $table->decimal('bi_monthly', 10, 2)->default(0);
            $table->integer('actual_days_worked')->default(0);
            $table->decimal('absences', 10, 2)->default(0);
            $table->decimal('vlsl', 10, 2)->nullable();
            $table->decimal('regular_worked_days', 10, 2)->default(13);
            $table->decimal('rwd_amount', 10, 2)->default(0);
            $table->decimal('legal_worked_days', 10, 2)->default(0);
            $table->decimal('lhd_amount', 10, 2)->default(0);
            $table->decimal('leave_amount', 10, 2)->default(0);
            $table->decimal('special_rate', 10, 2)->default(0);
            $table->decimal('special_worked_days', 10, 2)->default(0);
            $table->decimal('special_amount', 10, 2)->default(0);
            $table->decimal('total_monthly', 10, 2)->default(0);
            $table->decimal('total_basic_pay',10, 2)->default(0);
            $table->decimal('overtime_rate25',10, 2)->default(0);
            $table->decimal('ot_hours25',10, 2)->default(0);
            $table->decimal('ot_amount25',10, 2)->default(0);
            $table->decimal('overtime_rate30',10, 2)->default(0);
            $table->decimal('ot_hours30',10, 2)->default(0);
            $table->decimal('ot_amount30',10, 2)->default(0);
            $table->decimal('overtime_rate100',10, 2)->default(0);
            $table->decimal('ot_hours100',10, 2)->default(0);
            $table->decimal('ot_amount100',10, 2)->default(0);
            $table->decimal('total_ot',10, 2)->default(0);
            $table->decimal('total_basic_pay_plus_ot',10, 2)->default(0);
            $table->decimal('nd_rate',10, 2)->default(0);
            $table->decimal('nd_hours',10, 2)->default(0);
            $table->decimal('nd_amount',10, 2)->default(0);



            $table->string('sss_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->string('tin_number')->nullable();
            $table->integer('monthly_compensation')->nullable();
            $table->integer('number_dependents')->nullable();
            $table->string('name_dependents')->nullable();



            // Emergency contact
            $table->string('emergency_name');
            $table->string('emergency_phonenumber');
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
