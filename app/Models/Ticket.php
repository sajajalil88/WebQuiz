<?php

namespace App\Models;

use App\Models\User;
use App\Models\Events;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    public function getEvent(){
        return $this->belongsTo(Events::class,'event_id','id');
    }
    public function getUser(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
