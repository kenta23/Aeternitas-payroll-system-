<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('employee_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->string('email');
            $table->string('birth_date');
            $table->string('sex')->nullable();
            $table->integer('age')->nullable();
            $table->string('position');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('phone_number')->nullable();
            $table->mediumText('current_address')->nullable();
            $table->string('pay_type')->default('monthly');
            $table->decimal('per_day', 10, 2)->default(0);
            $table->decimal('per_month', 10, 2)->nullable();
            $table->decimal('basic_pay', 10, 2)->default(0);
            $table->decimal('allowance', 10, 2)->default(0);
            $table->decimal('monthly_pay', 10, 2)->default(0);
            $table->decimal('bi_monthly', 10, 2)->default(0);
            $table->integer('actual_days_worked')->default(0);
            $table->decimal('absences', 10, 2)->default(0);


            //payslip
            $table->date('start_date_payroll')->nullable();
            $table->date('end_date_payroll')->nullable();


            //TOTAL AMOUNTS
            $table->decimal('regular_worked_days', 10, 2)->default(13);
            $table->decimal('total_worked_days', 10, 2)->default(0);
            $table->decimal('rwd_amount', 10, 2)->default(0);
            $table->decimal('legal_worked_days', 10, 2)->default(0);
            $table->decimal('lhd_amount', 10, 2)->default(0);
            $table->decimal('leave_amount', 10, 2)->default(0);

            //special rate
            $table->decimal('special_rate', 10, 2)->default(0);
            $table->decimal('special_worked_days', 10, 2)->default(0);
            $table->decimal('special_amount', 10, 2)->default(0);

            //basic pay and gross
            $table->decimal('total_basic_pay', 10, 2)->default(0);
            $table->decimal('total_basic_pay_plus_ot', 10, 2)->default(0);
            $table->decimal('gross_pay', 10, 2)->default(0);

            //overtime
            $table->decimal('ot_rate25', 10, 2)->default(0);
            $table->decimal('ot_hours25', 10, 2)->default(0);
            $table->decimal('ot_amount25', 10, 2)->default(0);
            $table->decimal('ot_rate30', 10, 2)->default(0);
            $table->decimal('ot_hours30', 10, 2)->default(0);
            $table->decimal('ot_amount30', 10, 2)->default(0);
            $table->decimal('ot_rate100', 10, 2)->default(0);
            $table->decimal('ot_hours100', 10, 2)->default(0);
            $table->decimal('ot_amount100', 10, 2)->default(0);
            $table->decimal('total_ot', 10, 2)->default(0);

            //night differential
            $table->decimal('nd_rate', 10, 2)->default(0);
            $table->decimal('nd_hours', 10, 2)->default(0);
            $table->decimal('nd_amount', 10, 2)->default(0);

            //lates
            $table->decimal('late_rate', 10, 2)->default(0);
            $table->integer('number_of_minutes_late')->default(0);
            $table->decimal('late_amount', 10, 2)->default(0);
            $table->decimal('missing_charges', 10, 2)->default(0);
            $table->decimal('total_charges', 10, 2)->default(0);


            //allowances
            $table->decimal('half_allowance', 10, 2)->default(0);
            $table->decimal('meal_allowance', 10, 2)->default(0);

            $table->decimal('grosspay', 10, 2)->nullable();

            //CONTRIBUTIONS AND TAXES
            $table->decimal('sss_premcontribution', 10, 2)->nullable();
            $table->decimal('sss_wisp', 10, 2)->nullable();
            $table->decimal('phic', 10, 2)->nullable();
            $table->decimal('hdmf', 10, 2)->nullable();
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('sss_loan', 10, 2)->nullable();
            $table->decimal('hdmf_loan', 10, 2)->nullable();
            $table->decimal('employee_purchase', 10, 2)->nullable();
            $table->decimal('uniform', 10, 2)->nullable();
            $table->decimal('cash_advance', 10, 2)->nullable();
            $table->decimal('otherdeduction', 10, 2)->nullable();


            $table->decimal('employer_sss_premcontribution', 10, 2)->nullable();
            $table->decimal('employer_sss_wisp', 10, 2)->nullable();
            $table->decimal('employer_phic', 10, 2)->nullable();
            $table->decimal('employer_hdmf', 10, 2)->nullable();

            $table->decimal('tax_sss_premcontribution', 10, 2)->nullable();
            $table->decimal('tax_sss_wisp', 10, 2)->nullable();
            $table->decimal('tax_phic', 10, 2)->nullable();
            $table->decimal('tax_hdmf', 10, 2)->nullable();
            $table->decimal('totalremittance', 10, 2)->nullable();
            $table->decimal('taxable_income', 10, 2)->nullable();
            $table->decimal('tax_cl', 10, 2)->nullable();
            $table->decimal('tax_excess', 10, 2)->nullable();

            $table->decimal('tax_rate_percentage', 10, 2)->nullable();
            $table->decimal('tax_rate', 10, 2)->nullable();
            $table->decimal('fixed_rate', 10, 2)->nullable();
            $table->decimal('tax_month', 10, 2)->nullable();
            $table->decimal('tax_cutoff', 10, 2)->nullable();
            $table->decimal('total_deduction', 10, 2)->nullable();
            $table->decimal('netpay', 10, 2)->nullable();

            //remitances
            $table->string('sss_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('pagibig_number')->nullable();
            $table->string('tin_number')->nullable();
            $table->integer('monthly_compensation')->nullable();
            $table->integer('number_dependents')->nullable();
            $table->string('name_dependents')->nullable();

            //emergency
            $table->string('emergency_name')->nullable();
            $table->string('emergency_phonenumber')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->mediumText('emergency_address')->nullable();

            //separation date
            $table->date('separation_date')->nullable();
            $table->mediumText('separation_reason')->nullable();
            $table->mediumText('separation_remarks')->nullable();

            //timestamps
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
