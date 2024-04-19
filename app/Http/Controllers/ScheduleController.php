<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\User;
use App\Models\Day;

use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedule = Schedule::all();
        return view('pages.schedule.List')->with('schedule',$schedule);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $doctors = Doctor::all();
      
        return view('pages.schedule.Add')
            ->with('doctors',$doctors);
            
    }

    /**
     * Store a newly created resource in storage.
     */
    // Store method
public function store(Request $request)
{
    $request->validate([
        'start_time' => 'required',
        'end_time' => 'required',
        'day' => 'required|array',
        'message' => 'required',
        'doctor' => 'required',
    ]);

    $schedule = new Schedule();
    $schedule->start_date = $request->start_time;
    $schedule->end_date = $request->end_time;
    $schedule->message = $request->message;
    $schedule->day = json_encode($request->days);  // Store days as JSON
    $schedule->is_active = $request->status == 'active' ? 1 : 0;
    $schedule->doctor_id = $request->doctor;

    $schedule->save();

    return redirect()->route('schedule.index');
}

// Update method
public function update(Request $request, string $id)
{
    $request->validate([
        'start_time' => 'required',
        'end_time' => 'required',
        'status' => 'required',
        'days' => 'required|array',
        'message' => 'required',
        'doctor' => 'required',
    ]);

    $schedule = Schedule::find($id);
    $schedule->start_date = $request->start_time;
    $schedule->end_date = $request->end_time;
    $schedule->message = $request->message;
    $schedule->day = json_encode($request->days);  // Store days as JSON
    $schedule->is_active = $request->status == 'active' ? 1 : 0;
    $schedule->doctor_id = $request->doctor;

    $schedule->save();

    return redirect()->route('schedule.index');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctors = Doctor::all();
        $data = Schedule::find($id);
        return view('pages.schedule.Add')
            ->with('doctors',$doctors)
            ->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Remov the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        $code = 200;
        $msg = 'The selected doctor has been successfully deleted!';
        return response()->json([
            'code' => $code,
            'msg'=>$msg
        ]);
    }
}
