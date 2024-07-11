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
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('employee_id')->nullable();
            $table->string('position')->nullable();
            $table->integer('phone_number')->nullable();
            $table->mediumText('current_address')->nullable();
            $table->string('pay_type')->nullable();
            $table->integer('per_day')->nullable();
            $table->integer('basic_pay');
            $table->integer('per_month')->nullable();
            $table->integer('sss_number')->nullable();
            $table->integer('philhealth_number')->nullable();
            $table->integer('pagibig_number')->nullable();
            $table->integer('tin_number')->nullable();
            $table->integer('monthly_compensation')->nullable();
            $table->integer('number_dependents')->nullable();
            $table->string('name_dependents')->nullable();


            //emergency contact
            $table->string('emergency_name')->nullable();
            $table->integer('emergency_phonenumber')->nullable();
            $table->string('emergency_relationship')->nullable();
            $table->mediumText('emergency_address')->nullable();

            //seperation
            $table->timestamp('seperation_date')->useCurrent()->nullable();
            $table->mediumText('seperation_reason')->nullable();
            $table->mediumText('seperation_remarks')->nullable();

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
