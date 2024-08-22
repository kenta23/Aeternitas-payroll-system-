<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Models\Employee;
use App\Mail\PayslipMail;
use App\Models\department;
use App\Models\positionType;
use Illuminate\Http\Request;
use App\Jobs\SendPayslipEmail;
use App\Models\permission_list;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\module_permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /** all employee card view */
    public function cardAllEmployee(Request $request)
    {
        $position = positionType::all();

        /*$users = DB::table('users')
                    ->join('employees','users.user_id','employees.employee_id')
                    ->select('users.*','employees.birth_date', 'employees.gender','employees.position')
                    ->get(); */

        $employees = Employee::all();
        $departments = department::all();
        //$permission_lists = DB::table('permission_lists')->get();

        return view('employees.allemployeecard',compact('employees', 'position','departments'));
    }

    /** all employee list */
    public function listAllEmployee()
    {
        $position = positionType::all();
        $employees = Employee::with('department')->get();
        $departments = department::all();



        return view('employees.employeelist',compact('employees', 'position','departments'));
    }

    /** save new data employee */
public function saveRecord(Request $request)
  {
    //try {
        \Log::info('Request data:', $request->all());

       try {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email',
            'middle_name' => 'nullable|string|max:255',
            'birth_date' => 'required|date',
            'sex' => 'nullable|string',
            'position' => 'required|string',
            'department_id' => 'required|exists:departments,id',
            'phone_number' => 'nullable|string|regex:/^9[0-9]{9}$/',
            'current_address' => 'nullable|string',
            'emergency_name' => 'required|string',
            'emergency_phonenumber' => 'nullable|string|regex:/^9[0-9]{9}$/',
            'emergency_relationship' => 'required|string',
            'emergency_address' => 'required|string',
           ]);

           // Generate custom ID
           $latestEmployee = Employee::latest()->first();
           $latestId = $latestEmployee ? intval(substr($latestEmployee->employee_id, 4)) : 0;
           $newId = 'PPH_' . str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);


           $employee = new Employee;
           $employee->fill($validatedData);
           $employee->employee_id = $newId;
           $employee->save();

           Toastr::success('Successully Added employee', 'Success');
           return redirect()->route('all/employee/card');

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'data' => $employee]);
         } else {
            return redirect()->route('all/employee/card')->with('success', 'Employee created successfully.');
        }
       }

       catch(\Exception $e) {
         Toastr::error('Failed to add employee', 'Error');
         return redirect()->route('all/employee/card');
       }
  }

    /** view edit record */
    public function viewRecord($employee_id)
    {

        $employees = Employee::with('department')->where('employee_id', $employee_id)->get();

        $position = positionType::all();
        $departments = department::all();

        return view('employees.edit.editemployee',compact('employees', 'position', 'departments'));
    }

    public function timekeeping() {
        $employees = Employee::where('per_month', '!=', 'null')->where('bi_monthly', '!=', 'null')->paginate(15);

        $position = PositionType::all();

        return view('employees.timekeeping', compact('employees'));
    }

    public function timekeepingEdit($employee_id) {
        $employee = Employee::where('employee_id', $employee_id)->first();

        if (!$employee) {
            return response()->json(['message' => 'Employee not found'], 404);
        }

        $computedOtRate25 = round(($employee->per_day / 8) * 1.25, 2);
        $computedOtAmount25 = round($computedOtRate25 * $employee->ot_hours25, 2);

        $computedOtRate30 = round(($employee->per_day / 8) * 1.30, 2);
        $computedOtAmount30 = round($computedOtRate30 * $employee->ot_hours30, 2);

        $computedOtRate100 = round(($employee->per_day / 8) * 2.00, 2); // Assuming double rate for 100%
        $computedOtAmount100 = round($computedOtRate100 * $employee->ot_hours100, 2);


        //leave table
        $leave = $employee->leave()->first();

        $response = [
            'id' => $employee->id,
            'employee_id' => $employee->employee_id,
            'name' => $employee->first_name . ' ' . $employee->last_name,
            'daily_rate'=>$employee->per_day,
            'position' => $employee->position,
            'regular_worked_days' => $employee->regular_worked_days,
            'absences' =>$employee->absences,
            'legal_worked_days' => $employee->legal_worked_days,
            'lhd_amount'=>$employee->lhd_amount,

            'special_worked_days' => $employee->special_worked_days,
            'special_rate'=>$employee->special_rate,
            'special_amount' => $employee->special_amount,
            'bi_monthly' => $employee->bi_monthly,
            'rwd_amount' => $employee->rwd_amount,

            // Overtimes
            'ot_rate25' => $employee->ot_rate25,
            'ot_hours25' => $employee->ot_hours25,
            'ot_amount25' => $employee->ot_amount25,
            'ot_rate30' => $employee->ot_rate30,
            'ot_hours30' => $employee->ot_hours30,
            'ot_amount30' => $employee->ot_amount30,
            'ot_rate100' => $employee->ot_rate100,
            'ot_hours100' => $employee->ot_hours100,
            'ot_amount100' => $employee->ot_amount100,
            'total_ot' => $employee->total_ot,

            //lates
            'late_rate' => $employee->late_rate,
            'late_amount' => $employee->late_amount,
            'number_of_minutes_late' => $employee->number_of_minutes_late,

            //night differential
            'night_differential' => $employee->nd_rate,
            'nd_rate' => $employee->nd_rate,
            'nd_hours' => $employee->nd_hours,
            'nd_amount' => $employee->nd_amount,


            'total_basic_pay_plus_ot' => $employee->total_basic_pay_plus_ot,
            'total_basic_pay' => $employee->total_basic_pay,
            'gross_pay' => $employee->gross_pay,

            'half_allowance' => $employee->half_allowance,
            'meal_allowance' => $employee->meal_allowance,

            //leave
            'leave_amount' => $employee->leave_amount,
            'credits_vl' => ($leave ? $leave->credits_vl : 0),
            'used_vl' => ($leave ? $leave->used_vl : 0),
            'balance_vl' => ($leave ? $leave->balance_vl : 0),
            'credits_sl' => ($leave ? $leave->credits_sl : 0),
            'used_sl' => ($leave ? $leave->used_sl : 0),
            'balance_sl' => ($leave ? $leave->balance_sl : 0),
            'total_credit_points' => ($leave ? $leave->total_credit_points : 0),
            'total_used_vlsl' => ($leave ? $leave->total_used_vlsl : 0),

        ];

        return response()->json($response);
    }

    public function updateTimekeeping(Request $request) {
      //dd($request->all());
      DB::beginTransaction();

            $regulardays = $request->regular_worked_days;
            $absences  = $request->absences;
           // $actualWorkedDays = $regulardays - $absences;
            $employeeId = $request->id;

       try {
         $updateValues = [
            'regular_worked_days' => $regulardays,
            'absences' => $absences ,
            'actual_days_worked' => $request->input('month_rate_paid_days'),
            'legal_worked_days' => $request->input('legal_worked_days'),
            'lhd_amount' => $request->input('lhd_amount'),

            'special_rate' => $request->input('special_rate'),
            'special_worked_days' => $request->input('special_worked_days'),
            'special_amount' => $request->input('special_amount'),

            'ot_rate25' => $request->input('ot_rate25'),
            'ot_hours25' => $request->input('ot_hours25'),
            'ot_amount25' => $request->input('ot_amount25'),
            'ot_rate30' => $request->input('ot_rate30'),
            'ot_hours30' => $request->input('ot_hours30'),
            'ot_amount30' => $request->input('ot_amount30'),
            'ot_rate100' => $request->input('ot_rate100'),
            'ot_hours100' => $request->input('ot_hours100'),
            'ot_amount100' => $request->input('ot_amount100'),
            'total_ot' => $request->input('total_ot'),

            //lates
            'late_rate' => $request->input('deduction_rate'),
            'late_amount' => $request->input('late_amount'),
            'number_of_minutes_late' => $request->input('no_of_minutes'),

             //leave
             'leave_amount' => $request->input('leave_amount'),

             //night differential
             'nd_rate' => $request->input('nd_rate'),
             'nd_hours' => $request->input('nd_hours'),
             'nd_amount' => $request->input('nd_amount'),

             'half_allowance' =>$request->input('allowance'),
             'meal_allowance' => $request->input('meal'),

             //total amounts
             'total_basic_pay_plus_ot' => $request->input('basic_pay_plus_ot'),
             'gross_pay' => $request->gross_pay,
             'total_basic_pay' => $request->basic_pay,
             'rwd_amount' => $request->rwd_amount,

        ];

           //first update the employee
           $leaveData = [
            'credits_vl' => $request->input('credits_vl'),
            'used_vl' => $request->input('used_vl'),
            'balance_vl' => $request->input('balance_vl'),
            'credits_sl' => $request->input('credits_sl'),
            'used_sl' => $request->input('used_sl'),
            'balance_sl' => $request->input('balance_sl'),
            'total_credit_points' => $request->input('credit_points'),
            'total_used_vlsl' => $request->input('used_credit'),
           ];


           $employee = Employee::findOrFail($employeeId);
           $employee->leave()->updateOrCreate([], $leaveData);


           $employee->update($updateValues);

           DB::commit();

          Toastr::success('Record updated succesfully','Success');
          return redirect()->route('employees/timekeeping');
       }

       catch(\Exception $e) {

         DB::rollback();
         Toastr::error('Failed to update please try again' . $e->getMessage(),'Error');
         return redirect()->back()->withInput()->withErrors(['error' => $e->getMessage()]);
       }
    }

    public function contributions() {

        $employees = Employee::paginate(15);
        $position = PositionType::all();

        return view('employees.contributions', compact('employees', 'position'));
    }

    public function editEmployeeContributions($employeeId) {
         try {
              $employee = Employee::where('employee_id', $employeeId)->firstOrFail();

              return view('employees.edit.editemployeetaxes', compact('employee'));
         }
         catch (\Exception $e) {
            Toastr::error('Fetching employee failed','Error');
            return redirect()->back();
         }
    }

    /** update record employee */
    public function updateRecord(EmployeeRequest $request)
    {
        DB::beginTransaction();

        try {
            $computedOtRate25 = round(($request->daily_rate / 8) * 1.25, 2);
            $computedOtRate30 = round(($request->daily_rate / 8) * 1.30, 2);
            $computedOtRate100 = round(($request->daily_rate / 8) * 2.00, 2); // Assuming double rate for 100%

            $specialRate = round($request->daily_rate * 0.3, 2);

              //lates
            $computedRateLates = round(($request->daily_rate / 8) / 60, 2);

            //night differential
            $nightDifferentialRate = round(($request->daily_rate / 8) * 0.1 , 2);

            //half allowance
            $halfAllowance = round($request->input('allowance') / 2, 2);


            // update table Employee
            $updateEmployee = [
                'first_name'=>$request->firstname,
                'last_name'=>$request->lastname,
                'email'=>$request->email,
                'birth_date'=>$request->birthdate,
                'sex' => $request->sex,
                'phone_number'=>$request->phone_number,
                'position'=>$request->position,
                'department_id'=>$request->department_id,
                'sss_number' => $request->sss_number,
                'current_address' => $request->address,
                'philhealth_number' => $request->philhealth,
                'tin_number' => $request->tin_number,
                'monthly_pay' => $request->input('monthly_pay'),
                'allowance' => $request->input('allowance'),
                'per_month'=>$request->input('total_monthly'),
                'bi_monthly'=>$request->input('bi_monthly'),
                'per_day'=>$request->input('daily_rate'),
                'special_rate' => $specialRate,
                'ot_rate25' => $computedOtRate25,
                'ot_rate30' => $computedOtRate30,
                'ot_rate100' => $computedOtRate100,
                'nd_rate' => $nightDifferentialRate,
                'late_rate' => $computedRateLates,
                'actual_days_worked' => 13,
                'half_allowance' => $halfAllowance,
            ];

            //dd($updateEmployee);

            Employee::where('id', $request->id)->update($updateEmployee);

            DB::commit();
            Toastr::success('Record successfully updated','Success');
            return redirect()->route('all/employee/card');

        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('updated record fail','Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function deleteRecord($employee_id)
    {
        DB::beginTransaction();
        try{
            $employee = Employee::find($employee_id)->first();
            if ($employee) {
                $employee->leave()->delete();
                $employee->attendances()->delete();
                $employee->delete();
            }

            DB::commit();
            Toastr::success('Delete record successfully','Success');
            return redirect()->route('all/employee/card');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error($e->getMessage(),'Error');
            return redirect()->back();
        }
    }

    /* update employee taxes */
    public function employeeTaxes($id, Request $request) {
        try {
            DB::beginTransaction();
            $employee = Employee::find($id);



            $updateValues = [
                'employee_purchase' => $request->input('employee_purchase'),
                'cash_advance' => $request->input('cash_advance'),
                'uniform' => $request->input('uniform'),
                'sss_loan' => $request->input('sss_loan'),
                'hdmf_loan' => $request->input('hdmf_loan'),
                'other_deduction' => $request->input('other_deduction'),

                //employer
                'employer_sss_premcontribution' => $request->input('employer_sss_premcontribution'),
                'employer_sss_wisp' => $request->input('employer_sss_wisp'),
                'employer_phic' => $request->input('employer_phic'),
                'employer_hdmf' => $request->input('employer_hdmf'),

                //employee
                'sss_premcontribution' => $request->input('employee_sss_premcontribution'),
                'sss_wisp' => $request->input('employee_sss_wisp'),
                'phic' => $request->input('employee_phic'),
                'hdmf' => $request->input('employee_hdmf'),

                //taxes
                'tax_sss_premcontribution' => $request->input('tax_sss_premcontribution'),
                'tax_sss_wisp' => $request->input('tax_sss_wisp'),
                'tax_phic' => $request->input('tax_phic'),
                'tax_hdmf' => $request->input('tax_hdmf'),


                'totalremittance' => $request->input('total_remittance'),
                'total_deduction' => $request->input('total_deduction'),
                'tax' => $request->input('tax'),
                'taxable_income' => $request->input('taxable_income'),
                'tax_cl' => $request->input('tax_cl'),
                'tax_excess' => $request->input('tax_excess'),
                'tax_rate_percentage' => $request->input('tax_rate_percentage'),
                'tax_rate' => $request->input('tax_rate'),
                'fixed_rate' => $request->input('fixed_rate'),
                'tax_month' => $request->input('tax_month'),
                'tax_cutoff' => $request->input('tax_cutoff'),
                'netpay' => $request->input('netpay'),
             ];

            $employee->update($updateValues);
            DB::commit();
            Toastr::success('Record successfully updated','Success');
            return redirect()->route('employees/contributions');

        }
        catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Department delete fail :)','Error');
            return redirect()->back();
        }

    }

    /** employee search */
    public function employeeSearch(Request $request, $viewName)
    {
        $query = Employee::query();
        $position = positionType::all();
        $departments = department::all();

        if ($request->filled('employee_id')) {
            $query->where('employee_id', 'LIKE', '%' . $request->employee_id . '%');
        }

        if ($request->filled('name')) {
            $fullname = trim($request->name);
            $parts = explode(' ', $fullname);
            $firstname = $parts[0];
            $lastname = isset($parts[1]) ? $parts[1] : '';

            $query->where('first_name', 'LIKE', '%' . $firstname . '%')
                  ->where('last_name', 'LIKE', '%' . $lastname . '%');
        }

        if ($request->filled('position')) {
            $query->where('position', 'LIKE', '%' . $request->position . '%');
        }

        $employees = $query->get();

        return view($viewName, ['employees' => $employees, 'position' => $position, 'departments' => $departments])->render();
    }


    public function employeeTimekeepingSearch(Request $request)
    {
       return $this->employeeSearch($request, 'employees.timekeeping');
    }


    public function employeeTaxSearch(Request $request)
    {
        return $this->employeeSearch($request, 'employees.contributions');
    }


    /** list search employee */
    public function employeeListSearch(Request $request)
    {
        return $this->employeeSearch($request, 'employees.employeelist');
    }

    public function employeeLeaveSearch(Request $request) {
         return $this->employeeSearch($request, 'employees.leaves');
    }
    /** employee profile with all controller user */
    public function profileEmployee($user_id)
    {
        $user = DB::table('users')
                ->leftJoin('personal_information as pi','pi.user_id','users.user_id')
                ->leftJoin('profile_information as pr','pr.user_id','users.user_id')
                ->leftJoin('user_emergency_contacts as ue','ue.user_id','users.user_id')
                ->select('users.*','pi.passport_no','pi.passport_expiry_date','pi.tel',
                'pi.nationality','pi.religion','pi.marital_status','pi.employment_of_spouse',
                'pi.children','pr.birth_date','pr.gender','pr.address','pr.country','pr.state','pr.pin_code',
                'pr.phone_number','pr.department','pr.designation','pr.reports_to',
                'ue.name_primary','ue.relationship_primary','ue.phone_primary','ue.phone_2_primary',
                'ue.name_secondary','ue.relationship_secondary','ue.phone_secondary','ue.phone_2_secondary')
                ->where('users.user_id',$user_id)->get();
        $users = DB::table('users')
                ->leftJoin('personal_information as pi','pi.user_id','users.user_id')
                ->leftJoin('profile_information as pr','pr.user_id','users.user_id')
                ->leftJoin('user_emergency_contacts as ue','ue.user_id','users.user_id')
                ->select('users.*','pi.passport_no','pi.passport_expiry_date','pi.tel',
                'pi.nationality','pi.religion','pi.marital_status','pi.employment_of_spouse',
                'pi.children','pr.birth_date','pr.gender','pr.address','pr.country','pr.state','pr.pin_code',
                'pr.phone_number','pr.department','pr.designation','pr.reports_to',
                'ue.name_primary','ue.relationship_primary','ue.phone_primary','ue.phone_2_primary',
                'ue.name_secondary','ue.relationship_secondary','ue.phone_secondary','ue.phone_2_secondary')
                ->where('users.user_id',$user_id)->first();

        return view('employees.employeeprofile',compact('user','users'));
    }

    /** page departments */
    public function index()
    {
        $departments = DB::table('departments')->get();
        return view('employees.departments',compact('departments'));
    }

    /** save record department */
    public function saveRecordDepartment(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $department = department::where('name',$request->department)->first();
            if ($department === null)
            {
                $department = new department;
                $department->name = $request->department;
                $department->save();

                DB::commit();
                Toastr::success('Successfully added department','Success');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Department already exits','Error');
                return redirect()->back();
            }
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Failed to add new department','Error');
            return redirect()->back();
        }
    }

    /** update record department */
    public function updateRecordDepartment(Request $request)
    {
        DB::beginTransaction();
        try {
            // update table departments
            $department = [
                'id'=>$request->id,
                'name'=>$request->department,
            ];
            department::where('id',$request->id)->update($department);

            DB::commit();
            Toastr::success('Successfully updated department','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Failed to update department','Error');
            return redirect()->back();
        }
    }

    /** delete record department */
    public function deleteRecordDepartment(Request $request)
    {
        try {
            department::destroy($request->id);
            Toastr::success('Department deleted successfully', 'Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Department delete fail :)', 'Error');
            return redirect()->back();
        }
    }

    /** page designations */
    public function designationsIndex()
    {
        return view('employees.designations');
    }

    /** page time sheet */
    public function timeSheetIndex()
    {
        return view('employees.timesheet');
    }

    /** page overtime */
    public function overTimeIndex()
    {
        return view('employees.overtime');
    }

    //sending mails
 public function sendPayslipMail (int $id)
 {
     try {
         //first, creating pdf file for payslip
         $employee = Employee::findOrFail($id);
         $todayDate = Carbon::now()->format('d-m-Y');

         $pdf = PDF::loadView('payroll.pdfpayslip', compact('employee'));
         $pdf->setOptions([
             'isHtml5ParserEnabled' => true,
             'isRemoteEnabled' => true
         ]);
         $pdf->setPaper('A4', 'portrait');
         $pdfStream = $pdf->output();


         Mail::mailer('smtp')->to($employee->email)->send(new PayslipMail($employee, $pdfStream));
         Toastr::success('Payslip has been sent to '. $employee->email, 'Success');
         return redirect()->back();

     } catch (\Exception $e) {
         Toastr::error('Failed to send email', 'Error');
         return redirect()->back();
     }
 }

 public function sendBulkMails () {

    $employees = Employee::all();

    try {
        foreach ($employees as $employee) {
            // Generate the PDF for each employee
            $pdf = PDF::loadView('payroll.pdfpayslip', compact('employee'));
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            $pdfContent = $pdf->output();

            // Dispatch the job for each employee
            SendPayslipEmail::dispatch($pdfContent, $employee);
        }

      Toastr::success('Successfully sent mails to all employees', 'Success');
      return redirect()->back();
    }
    catch(\Exception $e) {
         Toastr::error('Failed to send bulk mails', 'Error');
         return redirect()->back();
      }
   }
 }


