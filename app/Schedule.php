<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event; //ここを記述
use App\GuestSchedule; //ここを記述

class Schedule extends Model
{
    protected $fillable = [
        'id',
        'event_id',
        'schedule',
    ];
    
    //親DBを使うための記述
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    //子DBを使うための記述
    public function guest_schedules()
    {
        return $this->hasMany(GuestSchedule::class);
    }
    
    //日程ごとのpreferredを取得
    public function get_preferred($guest_id){
        $guest_schedule = $this->guest_schedules()->where('guest_id', $guest_id)->first();
        if(!$guest_schedule){
            return '';
        }
        
        return $guest_schedule->preferred;
    }
}
