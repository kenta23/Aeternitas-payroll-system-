<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Employee;
use App\Models\department;
use App\Models\positionType;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function index()
    {
        $employeesCount = Employee::count();
        $departmentsCount = department::count();
        $positionsCount = positionType::count();

        $employees = Employee::all();
        // Get the date from one month ago
        $oneMonthAgo = Carbon::now()->subMonth();

        // Query employees created within the last month
        $newEmployees = Employee::where('created_at', '>', $oneMonthAgo)->get();


        return view('dashboard.dashboard', compact('employeesCount', 'departmentsCount', 'positionsCount', 'employees', 'newEmployees'));
        
    }
    // employee dashboard
    public function emDashboard()
    {
        $dt        = Carbon::now();
        $todayDate = $dt->toDayDateTimeString();
        return view('dashboard.emdashboard',compact('todayDate'));
    }
    public function generatePDF(Request $request)
    {
        // $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        // $pdf = PDF::loadView('payroll.salaryview', $data);
        // return $pdf->download('text.pdf');
        // selecting PDF view
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
