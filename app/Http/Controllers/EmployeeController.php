<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\department;
use App\Models\User;
use App\Models\module_permission;
use App\Models\permission_list;
use App\Models\positionType;

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

    /** save data employee */
public function saveRecord(Request $request)
  {
    //try {
        \Log::info('Request data:', $request->all());

        $validatedData = $request->validate([
         'first_name' => 'required|string|max:255',
         'last_name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:employees,email',
         'birth_date' => 'required|date',
         'gender' => 'required|string',
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
        //return redirect()->route('all/employee/card');

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'data' => $employee]);
        } else {
            return redirect()->route('all/employee/card')->with('success', 'Employee created successfully.');
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
        $employees = Employee::paginate(10);

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

        // Total OT amount
        $totalOtAmount = round($computedOtAmount25 + $computedOtAmount30 + $computedOtAmount100, 2);



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
            'special_rate'=>$employee->special_rate,
            'special_amount' => $employee->special_amount,

            // Overtimes
            'ot_rate25' => $computedOtRate25,
            'ot_hours25' => $employee->ot_hours25,
            'ot_amount25' => $computedOtAmount25,
            'ot_rate30' => $computedOtRate30,
            'ot_hours30' => $employee->ot_hours30,
            'ot_amount30' => $computedOtAmount30,
            'ot_rate100' => $computedOtRate100,
            'ot_hours100' => $employee->ot_hours100,
            'ot_amount100' => $computedOtAmount100,
            'total_ot' => $totalOtAmount
        ];

        return response()->json($response);
    }

    public function updateTimekeeping(Request $request) {

         //dd($request->all());
         //split first name and last name
         $fullName = $request->input('name');
         // Split the full name into an array using space as the delimiter
         $nameParts = explode(' ', $fullName);
         // The first part of the array is the first name
         $firstName = $nameParts[0];
         $lastName = $nameParts[1];

       try {
         DB::beginTransaction();

         //calculate regular worked days - absences = actual worked days
         $regulardays = $request->regular_worked_days;
         $absences  = $request->absences;
         $actualWorkedDays = $regulardays - $absences;




         $updateValues = [
            'regular_worked_days' => $request->regular_worked_days,
            'absences' => $request->absences,
            'month_rate_paid_days',  //CONTINUE
            'actual_days_worked' => $actualWorkedDays,
            'legal_worked_days' ,
            'lhd_amount',
            'special_rate',
            'special_amount',
            'lhw_days',

            'ot_rate25' => $request->ot_rate25,
            'ot_hours25' => $request->ot_hours25,
            'ot_amount25' => $request->ot_amount25,
            'ot_rate30' => $request->ot_rate30,
            'ot_hours30' => $request->ot_hours30,
            'ot_amount30' => $request->ot_amount30,
            'ot_rate100' => $request->ot_rate100,
            'ot_hours100' => $request->ot_hours100,
            'ot_amount100' => $request->ot_amount100,
            'total_ot' => $request->total_ot
         ];


          //$employee->update($request->all());
          Employee::where('employee_id', $request->employee_id)->update();

          DB::commit();
          Toastr::success('Record updated succesfully','Success');
          return redirect()->route('employees/timekeeping');
       }
       catch(\Exception $e) {
         DB::rollback();
         Toastr::error('Failed to update please try again','Error');
         return redirect()->back();
       }
    }

    /** update record employee */
    public function updateRecord(EmployeeRequest $request)
    {
        DB::beginTransaction();

        try {
            // update table Employee
            $updateEmployee = [
                'first_name'=>$request->firstname,
                'last_name'=>$request->lastname,
                'email'=>$request->email,
                'birth_date'=>$request->birthdate,
                'gender'=>$request->gender,
                'phone_number'=>$request->phone_number,
                'position'=>$request->position,
                'department_id'=>$request->department_id,
                'sss_number' => $request->sss_number,
                'philhealth_number' => $request->philhealth,
                'tin_number' => $request->tin_number,
                'monthly_pay' => $request->input('monthly_pay'),
                'allowance' => $request->input('allowance'),
                'basic_pay'=>$request->input('total_monthly'),
                'bi_monthly'=>$request->input('bi_monthly'),
                'per_day'=>$request->input('daily_rate'),
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
            Employee::where('employee_id',$employee_id)->delete();
            //module_permission::where('employee_id',$employee_id)->delete();

            DB::commit();
            Toastr::success('Delete record successfully :)','Success');
            return redirect()->route('all/employee/card');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Delete record fail :)','Error');
            return redirect()->back();
        }
    }

    /** employee search */
    public function employeeSearch(Request $request)
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

        // Return the rendered view as JSON for AJAX
        //$html = view('employees.employee_list', ['employees' => $employees])->render();

        return view('employees.allemployeecard', ['employees' => $employees, 'position' => $position, 'departments' => $departments])->render();
    }

    /** list search employee */
    public function employeeListSearch(Request $request)
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

        // Return the rendered view as JSON for AJAX
        //$html = view('employees.employee_list', ['employees' => $employees])->render();

        return view('employees.employeelist',compact('employees','position','departments'));
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

            $department = department::where('department',$request->department)->first();
            if ($department === null)
            {
                $department = new department;
                $department->department = $request->department;
                $department->save();

                DB::commit();
                Toastr::success('Add new department successfully :)','Success');
                return redirect()->back();
            } else {
                DB::rollback();
                Toastr::error('Add new department exits :)','Error');
                return redirect()->back();
            }
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add new department fail :)','Error');
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
                'department'=>$request->department,
            ];
            department::where('id',$request->id)->update($department);

            DB::commit();
            Toastr::success('updated record successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('updated record fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record department */
    public function deleteRecordDepartment(Request $request)
    {
        try {
            department::destroy($request->id);
            Toastr::success('Department deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Department delete fail :)','Error');
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

}
