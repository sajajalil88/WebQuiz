<?php

namespace App\Models;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'doctor_schedules';
    protected $fillable = [
        'start_date', 
        'end_date', 
        'message', 
        'day', 
        'is_active', 
        'doctor_id'
    ];
    

    public function getDoctor(){
        return $this->belongsTo(Doctor::class,'doctor_id','id');
    }
}
