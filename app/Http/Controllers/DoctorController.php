<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Doctor;
use App\Models\UserRole;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $doctors = Doctor::all();
        return view('pages.doctor.List', ['doctors' => $doctors]);
    }
    public function create()
    { 
      return view('pages.doctor.Add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5|max:255',
            'speciality' => 'required|string|max:255',
            'mobile' => 'required|string|min:5|max:255',
            'image' => 'required|image|max:2048',  // Update the field name to 'image'
        ]);
    
        try {
            // Handle file upload
            $filename = time() . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/myImages', $filename); // Store in 'storage/app/public/myImages'
    
            $doctor = new Doctor();  // Create a new Doctor object
            $doctor->name = $request->name;
            $doctor->speciality = $request->speciality;
            $doctor->mobile = $request->mobile;
            $doctor->image = 'storage/myImages/' . $filename; // Adjust path if necessary
          
    
            $doctor->save();
    
        } catch (\Exception $e) {
            dd($e->getMessage()); // Debugging
            return redirect()->back()->with('error', 'Error saving doctor. Please try again.');
        }
    
        return redirect()->route('doctor.index')->with('success', 'Doctor added successfully.');
    }
    public function edit($id){
        $doctor = Doctor::find($id);
           
        return view('pages.doctor.Add')->with('object', $doctor);
    }
    
    public function update($id, Request $request)
    {
        $obj = Doctor::find($id);
    
        if (!$obj) {
            return redirect()->route('doctor.index')->with('error', 'Doctor not found.');
        }
    
        $obj->name = $request->name;
        $obj->speciality = $request->speciality;
        $obj->mobile = $request->mobile;
    
        if ($request->hasFile('image')) {
            $filename = time() . "-" . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/myImages', $filename); // Store in 'storage/app/public/myImages'
            $obj->image = 'storage/myImages/' . $filename; // Adjust path if necessary
        }
    
        $obj->save();
    
        return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully.');
    }
    

public function destroy($id){

    $data = Doctor::find($id);
     $data->delete();
     return redirect()->route('doctor.index')->with('success', 'User deleted successfully.');
    }

}
