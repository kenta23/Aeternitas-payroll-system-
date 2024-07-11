<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\department;
use App\Models\User;
use App\Models\module_permission;
use App\Models\positionType;

class EmployeeController extends Controller
{
    /** all employee card view */
    public function cardAllEmployee(Request $request)
    {
        $position = positionType::all();

        $users = DB::table('users')
                    ->join('employees','users.user_id','employees.employee_id')
                    ->select('users.*','employees.birth_date', 'employees.gender','employees.position')
                    ->get();

        $employeeList = Employee::all();
        //$permission_lists = DB::table('permission_lists')->get();


        return view('employees.allemployeecard',compact('employeeList', 'position',));
    }

    /** all employee list */
    public function listAllEmployee()
    {
        $position = positionType::all();

        $users = DB::table('users')
                    ->join('employees','users.user_id', 'employees.employee_id')
                    ->select('users.*','employees.birth_date','employees.gender','employees.position')
                    ->get();
        $userList = DB::table('users')->get();

        $permission_lists = DB::table('permission_lists')->get();
        return view('employees.employeelist',compact('users','userList', 'position', 'permission_lists'));
    }

    /** save data employee */
public function saveRecord(Request $request)
  {
    /*  $validatedData = $request->validate([
        'firstname'              => 'required|string|max:255',
        'lastname'               => 'required|string|max:255',
        'email'                  => 'required|string|email|max:255|unique:employees,email',
        'birthDate'              => 'required|date',
        'gender'                 => 'required|string|max:255',
        'position'               => 'required|string|max:255',
        'phone'                  => 'nullable|string|max:11',
        'emergency_name'         => 'required|string|max:255',
        'emergency_phonenumber'  => 'nullable|string|max:11',
        'emergency_relationship' => 'required|string|max:255',
        'emergency_address'      => 'required|string|max:255',
        'current_address'        => 'required|string|max:255',
    ]);

    try {
        $employee = new Employee;

        $employee->first_name           = $request->firstname;
        $employee->last_name            = $request->lastname;
        $employee->email                = $request->email;
        $employee->birth_date           = $request->birthDate;
        $employee->gender               = $request->gender;
        $employee->position             = $request->position;
        $employee->phone_number         = $request->phone;
        $employee->current_address      = $request->current_address;

        // Emergency contact
        $employee->emergency_name           = $request->emergency_name;
        $employee->emergency_phonenumber    = $request->emergency_phonenumber;
        $employee->emergency_relationship   = $request->emergency_relationship;
        $employee->emergency_address        = $request->emergency_address;
    */
    //try {
        \Log::info('Request data:', $request->all());

        $validatedData = $request->validate([
         'first_name' => 'required|string|max:255',
         'last_name' => 'required|string|max:255',
         'email' => 'required|string|email|max:255|unique:employees,email',
         'birth_date' => 'required|date',
         'gender' => 'required|string',
         'position' => 'required|string',
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
        $newId = 'PH_' . str_pad($latestId + 1, 3, '0', STR_PAD_LEFT);

       /* $employeeData = [
        'employee_id' => $newId,
        'first_name' => $validatedData['first_name'],
        'last_name' => $validatedData['last_name'],
        'email' => $validatedData['email'],
        'birth_date' => $validatedData['birth_date'],
        'gender' => $validatedData['gender'],
        'position' => $validatedData['position'],
        'phone_number' => $validatedData['phone_number'] ?? NULL,
        'current_address' => $validatedData['current_address'] ?? NULL,
        'emergency_name' => $validatedData['emergency_name'],
        'emergency_phonenumber' => $validatedData['emergency_phonenumber'],
        'emergency_relationship' => $validatedData['emergency_relationship'],
        'emergency_address' => $validatedData['emergency_address'],
        ]; */

        $employee = new Employee;
        $employee->fill($validatedData);
        $employee->employee_id = $newId;
        $employee->save();

        Toastr::success('Add new employee successfully :)', 'Success');
        //return redirect()->route('all/employee/card');

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'data' => $employee]);
        } else {
            return redirect()->route('all/employee/card')->with('success', 'Employee created successfully.');
        }
        
        
     /*catch(\Exception $e){

        Toastr::error('Add new employee fail :)','Error');
        return redirect()->back();
    }*/
}


    /** view edit record */
    public function viewRecord($employee_id)
    {
        $permission = DB::table('employees')
            ->join('module_permissions','employees.employee_id','module_permissions.employee_id')
            ->select('employees.*','module_permissions.*')->where('employees.employee_id',$employee_id)->get();
        $employees = DB::table('employees')->where('employee_id',$employee_id)->get();
        return view('employees.edit.editemployee',compact('employees','permission'));
    }

    /** update record employee */
    public function updateRecord( Request $request)
    {
        DB::beginTransaction();
        try {

            // update table Employee
            $updateEmployee = [
                'id'=>$request->id,
                'name'=>$request->name,
                'email'=>$request->email,
                'birth_date'=>$request->birth_date,
                'gender'=>$request->gender,
                'employee_id'=>$request->employee_id,
                'position'=>$request->position,
            ];

            // update table user
            $updateUser = [
                'id'=>$request->id,
                'name'=>$request->name,
                'email'=>$request->email,
            ];

            // update table module_permissions
            for($i = 0;$i<count($request->id_permission);$i++)
            {
                $UpdateModule_permissions = [
                    'employee_id' => $request->employee_id,
                    'module_permission' => $request->permission[$i],
                    'id'                => $request->id_permission[$i],
                    'read'              => $request->read[$i],
                    'write'             => $request->write[$i],
                    'create'            => $request->create[$i],
                    'delete'            => $request->delete[$i],
                    'import'            => $request->import[$i],
                    'export'            => $request->export[$i],
                ];
                module_permission::where('id',$request->id_permission[$i])->update($UpdateModule_permissions);
            }

            User::where('id',$request->id)->update($updateUser);
            Employee::where('id',$request->id)->update($updateEmployee);

            DB::commit();
            Toastr::success('updated record successfully :)','Success');
            return redirect()->route('all/employee/card');
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('updated record fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function deleteRecord($employee_id)
    {
        DB::beginTransaction();
        try{
            Employee::where('employee_id',$employee_id)->delete();
            module_permission::where('employee_id',$employee_id)->delete();

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
        $users = DB::table('users')
                    ->join('employees','users.user_id','employees.employee_id')
                    ->select('users.*','employees.birth_date','employees.gender','employees.position')->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('users.name','LIKE','%'.$request->name.'%')->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date', 'employees.gender', 'employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }
        // search by name and position and id
        if($request->employee_id && $request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }
        return view('employees.allemployeecard',compact('users','userList','permission_lists'));
    }

    /** list search employee */
    public function employeeListSearch(Request $request)
    {
        $users = DB::table('users')
                    ->join('employees','users.user_id','employees.employee_id')
                    ->select('users.*','employees.birth_date','employees.gender','employees.position')->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList         = DB::table('users')->get();

        // search by id
        if($request->employee_id)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')->get();
        }
        // search by name
        if($request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('users.name','LIKE','%'.$request->name.'%')->get();
        }
        // search by name
        if($request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }

        // search by name and id
        if($request->employee_id && $request->name)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')->get();
        }
        // search by position and id
        if($request->employee_id && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }
        // search by name and position
        if($request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }
        // search by name and position and id
        if($request->employee_id && $request->name && $request->position)
        {
            $users = DB::table('users')
                        ->join('employees','users.user_id','employees.employee_id')
                        ->select('users.*','employees.birth_date','employees.gender','employees.position')
                        ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                        ->where('users.name','LIKE','%'.$request->name.'%')
                        ->where('users.position','LIKE','%'.$request->position.'%')->get();
        }
        return view('employees.employeelist',compact('users','userList','permission_lists'));
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
