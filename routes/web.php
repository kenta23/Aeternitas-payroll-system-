<?php

use App\Http\Controllers\LockScreen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\BankInformationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\PersonalInformationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/** for side bar menu active */
function set_active($route) {
    if (is_array($route )){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Route::get('/', function () {
    return view('home.homepage');
});

Route::group(['middleware'=>'auth'],function()
{
    Route::get('home',function()
    {
        return view('home');
    });
});

Auth::routes();

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function()
{
    // -----------------------------login----------------------------------------//
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'authenticate');
        Route::get('/logout', 'logout')->name('logout');
    });

    // ------------------------------ register ----------------------------------//
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('/register','storeUser')->name('register');
    });

    // ----------------------------- forget password ----------------------------//
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forget-password', 'getEmail')->name('forget-password');
        Route::post('forget-password', 'postEmail')->name('forget-password');
    });

    // ----------------------------- reset password -----------------------------//
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('reset-password/{token}', 'getPassword');
        Route::post('reset-password', 'updatePassword');
    });
})->middleware('auth');

Route::group(['namespace' => 'App\Http\Controllers'],function()
{
    // ----------------------------- main dashboard ------------------------------//
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::get('em/dashboard', 'emDashboard')->name('em/dashboard');
    });

    // ----------------------------- lock screen --------------------------------//
    Route::controller(LockScreen::class)->group(function () {
        Route::get('lock_screen','lockScreen')->middleware('auth')->name('lock_screen');
        Route::post('unlock', 'unlock')->name('unlock');
    });

    // -----------------------------settings-------------------------------------//
    Route::controller(SettingController::class)->group(function () {
        Route::get('company/settings/page', 'companySettings')->middleware('auth')->name('company/settings/page'); /** index page */
        Route::post('company/settings/save', 'saveRecord')->middleware('auth')->name('company/settings/save'); /** save record or update */
        Route::get('roles/permissions/page', 'rolesPermissions')->middleware('auth')->name('roles/permissions/page');
        Route::post('roles/permissions/save', 'addRecord')->middleware('auth')->name('roles/permissions/save');
        Route::post('roles/permissions/update', 'editRolesPermissions')->middleware('auth')->name('roles/permissions/update');
        Route::post('roles/permissions/delete', 'deleteRolesPermissions')->middleware('auth')->name('roles/permissions/delete');
        Route::get('localization/page', 'localizationIndex')->middleware('auth')->name('localization/page'); /** index page localization */
        Route::get('salary/settings/page', 'salarySettingsIndex')->middleware('auth')->name('salary/settings/page'); /** index page salary settings */
        Route::get('email/settings/page', 'emailSettingsIndex')->middleware('auth')->name('email/settings/page'); /** index page email settings */
    });

    // ----------------------------- manage users -------d-----------------------//
    Route::controller(UserManagementController::class)->group(function () {
        Route::get('profile_user', 'profile')->middleware('auth')->name('profile_user');
        Route::post('profile/information/save', 'profileInformation')->name('profile/information/save');
        Route::get('userManagement', 'index')->middleware('auth')->name('userManagement');
        Route::post('user/add/save', 'addNewUserSave')->name('user/add/save');
        Route::post('update', 'update')->name('update');
        Route::post('user/delete', 'delete')->middleware('auth')->name('user/delete');
        Route::get('change/password', 'changePasswordView')->middleware('auth')->name('change/password');
        Route::post('change/password/db', 'changePasswordDB')->name('change/password/db');

        Route::post('user/profile/emergency/contact/save', 'emergencyContactSaveOrUpdate')->name('user/profile/emergency/contact/save'); /** save or update emergency contact */
        Route::get('get-users-data', 'getUsersData')->name('get-users-data'); /** get all data users */

    });


    // ---------------------------- form employee ---------------------------//
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('all/employee/card', 'cardAllEmployee')->middleware('auth')->name('all/employee/card');
        Route::get('all/employee/list', 'listAllEmployee')->middleware('auth')->name('all/employee/list');
        Route::post('all/employee/save', 'saveRecord')->middleware('auth')->name('all/employee/save');
        Route::get('all/employee/view/edit/{employee_id}', 'viewRecord');
        Route::post('all/employee/update', 'updateRecord')->middleware('auth')->name('all/employee/update');
        Route::get('all/employee/delete/{employee_id}', 'deleteRecord')->middleware('auth');
        Route::post('all/employee/search', 'employeeCardSearch')->name('all/employee/search');
        Route::post('all/employee/list/search', 'employeeListSearch')->name('all/employee/list/search');
        Route::get('employee/timekeeping/edit/{employee_id}', 'timekeepingEdit')->middleware('auth')->name('employee/timekeeping/edit');
        Route::post('employee/timekeeping/update', 'updateTimekeeping')->middleware('auth')->name('employee/timekeeping/update');

        Route::get('employees/timekeeping', 'timekeeping')->middleware('auth')->name('employees/timekeeping');

        Route::post('employee/taxes/{id}', 'employeeTaxes')->middleware('auth');


        //search
        Route::post('employee/timekeeping/search', 'employeeTimekeepingSearch')->name('employee/timekeeping/search');
        Route::post('employee/search/tax-and-contributions', 'employeeTaxSearch')->name('employee/search/tax-and-contribution');

        //contributions
        Route::get('employees/contributions', 'contributions')->middleware('auth')->name('employees/contributions');
        Route::get('employees/edit/contributions/{employeeId}', 'editEmployeeContributions')->middleware('auth');

        Route::get('form/departments/page', 'index')->middleware('auth')->name('form/departments/page');
        Route::post('form/departments/save', 'saveRecordDepartment')->middleware('auth')->name('form/departments/save');
        Route::post('form/department/update', 'updateRecordDepartment')->middleware('auth')->name('form/department/update');
        Route::post('form/department/delete', 'deleteRecordDepartment')->middleware('auth')->name('form/department/delete');

        Route::get('form/designations/page', 'designationsIndex')->middleware('auth')->name('form/designations/page');
        Route::post('form/designations/save', 'saveRecordDesignations')->middleware('auth')->name('form/designations/save');
        Route::post('form/designations/update', 'updateRecordDesignations')->middleware('auth')->name('form/designations/update');
        Route::post('form/designations/delete', 'deleteRecordDesignations')->middleware('auth')->name('form/designations/delete');

        Route::get('form/timesheet/page', 'timeSheetIndex')->middleware('auth')->name('form/timesheet/page');
        Route::post('form/timesheet/save', 'saveRecordTimeSheets')->middleware('auth')->name('form/timesheet/save');
        Route::post('form/timesheet/update', 'updateRecordTimeSheets')->middleware('auth')->name('form/timesheet/update');
        Route::post('form/timesheet/delete', 'deleteRecordTimeSheets')->middleware('auth')->name('form/timesheet/delete');

        Route::get('form/overtime/page', 'overTimeIndex')->middleware('auth')->name('form/overtime/page');
        Route::post('form/overtime/save', 'saveRecordOverTime')->middleware('auth')->name('form/overtime/save');
        Route::post('form/overtime/update', 'updateRecordOverTime')->middleware('auth')->name('form/overtime/update');
        Route::post('form/overtime/delete', 'deleteRecordOverTime')->middleware('auth')->name('form/overtime/delete');


        //FOR SENDING MAIL
        Route::get('payslip/mali/send/{id}', 'sendPayslipMail')->middleware('auth');
        Route::get('payslip/mail/send/all', 'sendBulkMails')->middleware('auth');
    });

    // ----------------------------- position  -----------------------------//

    Route::middleware('auth')->resource('position', PositionController::class);

    // ------------------------- profile employee --------------------------//
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('employee/profile/{user_id}', 'profileEmployee')->middleware('auth');
    });



    // -------------------------- form leaves ----------------------------//
    Route::controller(LeavesController::class)->group(function () {


        Route::get('leave/employee/list', 'viewLeave')->name('leave.index'); //view for leave page
        Route::post('leave/employee/search', [EmployeeController::class, 'employeeLeaveSearch'])->name('leave/employee/search');
    })->middleware('auth');

    // ------------------------ form attendance  -------------------------//
    Route::controller(LeavesController::class)->group(function () {
        Route::get('form/leavesettings/page', 'leaveSettings')->middleware('auth')->name('form/leavesettings/page');
        Route::get('attendance/page', 'attendanceIndex')->middleware('auth')->name('attendance/page');
        Route::get('attendance/employee/page', 'AttendanceEmployee')->middleware('auth')->name('attendance/employee/page');
        Route::get('form/shiftscheduling/page', 'shiftScheduLing')->middleware('auth')->name('form/shiftscheduling/page');
        Route::get('form/shiftlist/page', 'shiftList')->middleware('auth')->name('form/shiftlist/page');
        Route::post('/attendance/add', 'addAttendance')->middleware('auth')->name('attendance/add');
    });

    // ------------------------ form payroll  ----------------------------//
    Route::controller(PayrollController::class)->group(function () {
        Route::get('form/sallary/page', 'sallary')->middleware('auth')->name('form/sallary/page');
        Route::get('employee/sallary/{employeeId}', 'getEmployeeSalary')->middleware('auth')->name('employee/sallary');
        Route::post('form/salary/save','saveRecord')->middleware('auth')->name('form/salary/save');
        Route::post('form/salary/update', 'updateRecord')->middleware('auth')->name('form/salary/update');
        Route::post('form/salary/delete', 'deleteRecord')->middleware('auth')->name('form/salary/delete');
        Route::get('form/salary/view/{user_id}', 'salaryView')->middleware('auth');
        Route::get('form/payroll/items', 'payrollItems')->middleware('auth')->name('form/payroll/items');
        Route::get('extra/report/pdf', 'reportPDF')->middleware('auth');
        Route::get('extra/report/excel', 'reportExcel')->middleware('auth');

        //download pdf
        Route::get('payslip/download/{id}', 'downloadPDF')->middleware('auth');
        Route::get('payslip/example/1', 'payslipsample')->middleware('auth');

        //payroll period
        Route::get('form/payrollperiod', 'viewPayrollPeriod')->middleware('auth')->name('form/payrollperiod');

        //debit memo
        Route::get('payroll/debitmemo', 'viewDebitMemo')->middleware('auth')->name('debitmemo');
        Route::get('payroll/getperiod', 'getPeriod')->middleware('auth')->name('debitmemo.index');
    });




    // ----------------------------- sales  ----------------------------//

    // ==================== user profile user ===========================//

    // ---------------------- personal information ----------------------//
    Route::controller(PersonalInformationController::class)->group(function () {
        Route::post('user/information/save', 'saveRecord')->middleware('auth')->name('user/information/save');
    });

    // ---------------------- bank information  -----------------------//
    Route::controller(BankInformationController::class)->group(function () {
        Route::post('bank/information/save', 'saveRecord')->middleware('auth')->name('bank/information/save');
    });
})->middleware('auth');
