<?php

namespace App\Http\Controllers;

use App\Models\positionType;
use Brian2694\Toastr\Facades\Toastr;
use Brian2694\Toastr\Toastr as ToastrToastr;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $positions = positionType::all();
        return view('employees.positions', compact('positions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            $position = positionType::where('position', $request->position)->first();

            if(empty($position)) {
                $position = new positionType();
                $position->position = $request->position;
                $position->save();

                Toastr::success('Position Created Successfully', 'Success');
                return redirect()->back();
            }
           else {
             Toastr::error('Position name duplicated, please try again', 'Error');
             return redirect()->back();
           }
        }
        catch(\Exception $e) {
            Toastr::error('Error creating position', 'Error');
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(positionType $positionType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(positionType $positionType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, positionType $positionType)
    {

       try {
        $request->validate([
            'position_name' => 'string|max:255',
        ]);

        $positionType->find($request->id)->update(['position' => $request->position_name]);

        Toastr::success('Position Name Updated Successfully', 'Success');
        return redirect()->back();
       }
       catch(\Exception $e) {
        Toastr::error('Error deleting position', 'Error');
        return redirect()->back()->with('error', $e->getMessage());
       }
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, positionType $positionType, $id)
    {
      try {
            $positionType->find($id)->delete();

            Toastr::success('Deleted Successfully', 'Success');
            return redirect()->back();
        }
        catch(\Exception $e) {
            Toastr::error('Error deleting position', 'Error');
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
