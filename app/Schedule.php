<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event; //ここを記述

class Schedule extends Model
{
    protected $fillable = [
        'id',
        'event_id',
        'schedule',
    ];
    
    //親DBを使うための記述
    public static function event()
    {
        return $this->belongsTo(Event::class);
    }
}
