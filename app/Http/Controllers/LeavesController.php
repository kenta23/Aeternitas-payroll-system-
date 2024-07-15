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
    public function addAttendance(Request $request) {
        //dd($request);
        //$validatedData = $request->validated();

        $employee = ModelsEmployee::where('employee_id', $request->employee)->get();


        $attendance = new AttendanceModel([
            'name' => "{$employee[0]->first_name} {$employee[0]->last_name}",
            'time_in' => $request->time_in,
            'time_out' => $request->time_out,
        ]);

         //$employee
        $employee->attendances()->save($attendance);

        Toastr::success('Attendance added','Success');
        return redirect()->back()->with('success', 'Attendance recorded successfully.');
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
        $attendances = AttendanceModel::with('employees')->get();

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
