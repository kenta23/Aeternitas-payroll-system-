<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use DB;
use App\Exports\SalaryExcel;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\StaffSalary;
use Brian2694\Toastr\Facades\Toastr;
use Barryvdh\DomPDF\Facade\Pdf;



class PayrollController extends Controller
{
    /** view page salary */
    public function sallary()
    {
        $employees = Employee::whereNotNull('netpay')->where('netpay','!=',0)->get();

        return view('payroll.employeesalary',compact('employees'));
    }

    public function downloadPDF($id) {
        $employee = Employee::find($id);

        $pdf = PDF::loadView('payroll.pdfpayslip', compact('employee'))->setPaper('a6', 'portrait');

        $todayDate = Carbon::now()->format('d-m-Y');

        return $pdf->download('employee'.$employee->id.'-'.$todayDate.'.pdf');
    }

    public function getEmployeeSalary($employeeId)
{
    $employee = Employee::where('employee_id', $employeeId)->first();

    if (!$employee) {
        return response()->json(['message' => 'Employee not found'], 404);
    }

    $response = [
        'id' => $employee->id,
        'employee_id' => $employee->employee_id,
        'name' => $employee->first_name . ' ' . $employee->last_name,
        'position' => $employee->position,
        'basic_pay' => $employee->total_basic_pay,
        'phone_number' =>$employee->phone_number,
        'per_day' => $employee->per_day,
        'allowance'=>$employee->allowance,
        'monthly_pay'=>$employee->monthly_pay,
        'bi_monthly' => $employee->bi_monthly,

    ];

    return response()->json($response);
}

    /** save record */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'salary'  => 'required|string|max:255',
            'basic'   => 'required|string|max:255',
            'da'      => 'required|string|max:255',
            'hra'     => 'required|string|max:255',
            'conveyance' => 'required|string|max:255',
            'allowance'  => 'required|string|max:255',
            'medical_allowance' => 'required|string|max:255',
            'tds' => 'required|string|max:255',
            'esi' => 'required|string|max:255',
            'pf'  => 'required|string|max:255',
            'leave'    => 'required|string|max:255',
            'prof_tax' => 'required|string|max:255',
            'labour_welfare' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            $salary = StaffSalary::updateOrCreate(['user_id' => $request->user_id]);
            $salary->name              = $request->name;
            $salary->user_id           = $request->user_id;
            $salary->salary            = $request->salary;
            $salary->basic             = $request->basic;
            $salary->da                = $request->da;
            $salary->hra               = $request->hra;
            $salary->conveyance        = $request->conveyance;
            $salary->allowance         = $request->allowance;
            $salary->medical_allowance = $request->medical_allowance;
            $salary->tds               = $request->tds;
            $salary->esi               = $request->esi;
            $salary->pf                = $request->pf;
            $salary->leave             = $request->leave;
            $salary->prof_tax          = $request->prof_tax;
            $salary->labour_welfare    = $request->labour_welfare;
            $salary->save();

            DB::commit();
            Toastr::success('Create new Salary successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Salary fail :)','Error');
            return redirect()->back();
        }
    }

    /** salary view detail */
    public function salaryView($user_id)
    {
        $employee = Employee::with('department')->find($user_id);

        return view('payroll.salaryview', compact('employee'));

    }

    /** update record */
    public function updateRecord(Request $request)
    {
        DB::beginTransaction();
        try{
            $update = [

                'id'      => $request->id,
                'name'    => $request->name,
                'salary'  => $request->salary,
                'basic'   => $request->basic,
                'da'      => $request->da,
                'hra'     => $request->hra,
                'conveyance' => $request->conveyance,
                'allowance'  => $request->allowance,
                'medical_allowance'  => $request->medical_allowance,
                'tds'  => $request->tds,
                'esi'  => $request->esi,
                'pf'   => $request->pf,
                'leave'     => $request->leave,
                'prof_tax'  => $request->prof_tax,
                'labour_welfare'  => $request->labour_welfare,
            ];


            StaffSalary::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Salary updated successfully :)','Success');
            return redirect()->back();

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Salary update fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function deleteRecord(Request $request)
    {
        DB::beginTransaction();
        try {

            StaffSalary::destroy($request->id);

            DB::commit();
            Toastr::success('Salary deleted successfully :)','Success');
            return redirect()->back();


        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Salary deleted fail :)','Error');
            return redirect()->back();
        }
    }

    /** payroll Items */
    public function payrollItems()
    {
        return view('payroll.payrollitems');
    }

    /** report pdf */
    public function reportPDF(Request $request)
    {
        $user_id = $request->user_id;
        $users = DB::table('users')
            ->join('staff_salaries', 'users.user_id', 'staff_salaries.user_id')
            ->join('profile_information', 'users.user_id', 'profile_information.user_id')
            ->select('users.*', 'staff_salaries.*','profile_information.*')
            ->where('staff_salaries.user_id',$user_id)->first();

            $pdf = PDF::loadView('report_template.salary_pdf',compact('users'))->setPaper('a4', 'landscape');
            return $pdf->download('ReportDetailSalary'.'.pdf');
    }

    /** export Excel */
    public function reportExcel(Request $request)
    {
        $user_id = $request->user_id;
        $users = DB::table('users')
            ->join('staff_salaries', 'users.user_id', 'staff_salaries.user_id')
            ->join('profile_information', 'users.user_id', 'profile_information.user_id')
            ->select('users.*', 'staff_salaries.*','profile_information.*')
            ->where('staff_salaries.user_id',$user_id)->get();


            return Excel::download(new SalaryExcel($user_id),'ReportDetailSalary'.'.xlsx');
    }
}
