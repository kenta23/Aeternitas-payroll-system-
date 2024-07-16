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
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('birth_date');
            $table->string('gender');
            $table->string('employee_id')->nullable();
            $table->string('position');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->string('phone_number')->nullable();
            $table->mediumText('current_address')->nullable();
            $table->integer('pay_type')->nullable();
            $table->integer('per_day')->nullable();
            $table->integer('basic_pay')->nullable();
            $table->integer('per_month')->nullable();
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

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
