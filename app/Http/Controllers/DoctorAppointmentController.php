<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\DoctorAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DoctorAppointmentController extends Controller
{
    public function index(){
        $appointments = DoctorAppointment::all();
        return view('pages.appointment.Add', ['appointments' => $appointments]);
    }
    public function create()
    {
        $doctors = Doctor::all();
        $patients = User::whereHas('roles', function ($query) {
            $query->where('key', env('USER'));
        })->get();
        
        return view('pages.appointment.Add', ['doctors' => $doctors, 'patients' => $patients]);
    }
    

    

public function store(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'doctor' => 'required|exists:doctors,id',
        'date' => 'required|date',
        'time' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Create a new appointment
    $appointment = new DoctorAppointment();
    $appointment->doctor_id = $request->doctor;
    $appointment->patient_id = Auth::id();  // Authenticated user's ID
    $appointment->date = $request->date;
    $appointment->time = $request->time;
    $appointment->description = $request->message ?? null; // Optional message
    $appointment->status = $request->status ?? 'Active'; // Default status

    $appointment->save();

    return redirect()->route('appointment.index')->with('success', 'Appointment created successfully.');
}

}
