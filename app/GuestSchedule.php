<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Schedule; //ここを記述
use App\Guest; //ここを記述

class GuestSchedule extends Model
{
    protected $fillable = [
        'id',
        'schedule_id',
        'guest_id',
        'preferred',
    ];
    
    //親DBを使うための記述
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
