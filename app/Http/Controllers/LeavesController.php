<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\LeavesAdmin;
use DB;
use DateTime;
use App\Http\Controllers\Employee;
use App\Models\AttendanceModel;
use App\Models\Employee as ModelsEmployee;
use Carbon\Carbon;

class LeavesController extends Controller
{
    /** leaves page */
    public function leaves()
    {
        $leaves = DB::table('leaves_admins')->join('users', 'users.user_id','leaves_admins.user_id')->select('leaves_admins.*', 'users.position','users.name','users.avatar')->get();
        return view('employees.leaves',compact('leaves'));
    }

    /** save record */
    public function saveRecord(Request $request)
    {
        $request->validate([
            'leave_type'   => 'required|string|max:255',
            'from_date'    => 'required|string|max:255',
            'to_date'      => 'required|string|max:255',
            'leave_reason' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $leaves = new LeavesAdmin;
            $leaves->user_id        = $request->user_id;
            $leaves->leave_type    = $request->leave_type;
            $leaves->from_date     = $request->from_date;
            $leaves->to_date       = $request->to_date;
            $leaves->day           = $days;
            $leaves->leave_reason  = $request->leave_reason;
            $leaves->save();

            DB::commit();
            Toastr::success('Create new Leaves successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Add Leaves fail :)','Error');
            return redirect()->back();
        }
    }

    /** edit record */
    public function editRecordLeave(Request $request)
    {
        DB::beginTransaction();
        try {

            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day     = $from_date->diff($to_date);
            $days    = $day->d;

            $update = [
                'id'           => $request->id,
                'leave_type'   => $request->leave_type,
                'from_date'    => $request->from_date,
                'to_date'      => $request->to_date,
                'day'          => $days,
                'leave_reason' => $request->leave_reason,
            ];

            LeavesAdmin::where('id',$request->id)->update($update);
            DB::commit();
            Toastr::success('Updated Leaves successfully :)','Success');
            return redirect()->back();
        } catch(\Exception $e) {
            DB::rollback();
            Toastr::error('Update Leaves fail :)','Error');
            return redirect()->back();
        }
    }

    /** delete record */
    public function deleteLeave(Request $request)
    {
        try {

            LeavesAdmin::destroy($request->id);
            Toastr::success('Leaves admin deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Leaves admin delete fail :)','Error');
            return redirect()->back();
        }
    }

    //ADDING EMPLOYEE'S ATTENDANCE
    public function addAttendance(Request $request)
    {
        //dd($request->all());
        //$validatedData = $request->validated();
        /*$request->validate([
            'name' => 'required|string|max:255',
            'time_in' => 'required|date_format:H:i',
            'time_out' => 'required|date_format:H:i',
            'overtime' => 'nullable|integer'
       ]);*/


        $employee = ModelsEmployee::where('employee_id', $request->employee)->first();

        if ($employee) {
           // Convert time_in from 12-hour to 24-hour format
           $time_in_24 = date("H:i", strtotime($request->input('time_in')));
          // Ensure time_out is already in 24-hour format
           $time_out_24 = $request->input('time_out');

            $attendance = new AttendanceModel([
                'name' => "{$employee->first_name} {$employee->last_name}",
                'employee_id' => $request->employee,
                'time_in' => $time_in_24,
                'time_out' => $time_out_24,
                'overtime' => $request->overtime,
            ]);


            $employee->attendances()->save($attendance);

            Toastr::success('Attendance added', 'Success');
            return redirect()->back()->with('success', 'Attendance recorded successfully.');

        } else {
            // Handle the case where the employee is not found
            Toastr::error('Attendance recorded fail', 'Error');
            return redirect()->back()->with('error', 'Attendance recorded fail.');
        }
    }

    /** leaveSettings page */
    public function leaveSettings()
    {
        return view('employees.leavesettings');
    }

    /** attendance admin */
    public function attendanceIndex()
    {
        return view('employees.attendance');
    }

    /** attendance employee */
    public function AttendanceEmployee()
    {
        $employees = ModelsEmployee::all();
       // $getEmployee = $employees->get();
        $attendances = AttendanceModel::all();

        //DATE FUNCTION
        $currentDate = \Carbon\Carbon::now()->format('F j, Y l');

        //get the real time data
        $currentTime = Carbon::now()->format('g:i A');

        return view('employees.attendanceemployee', compact('employees', 'currentDate', 'currentTime', 'attendances'));
    }

    /** leaves Employee */
    public function leavesEmployee()
    {
        return view('employees.leavesemployee');
    }

    /** shift scheduling */
    public function shiftScheduLing()
    {
        return view('employees.shiftscheduling');
    }

    /** shiftList */
    public function shiftList()
    {
        return view('employees.shiftlist');
    }
}
