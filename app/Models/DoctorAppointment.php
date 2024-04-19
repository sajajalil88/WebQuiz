<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAppointment extends Model
{
    use HasFactory;
     public function getDoctor(){
        return $this->belongsTo(User::class,'doctor_id','id');
    }
    public function getPatient(){
        return $this->belongsTo(Patient::class,'patient_id','id');
    }
}
