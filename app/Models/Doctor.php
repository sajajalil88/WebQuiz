<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    public function getSchedule(){
        return $this->hasOne(Schedule::class);
    }
    protected $fillable = ['name', 'speciality', 'mobile', 'image_path'];

}
