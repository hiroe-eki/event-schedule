<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event; //ここを記述

class Guest extends Model
{
    protected $fillable = [
        'id',
        'event_id',
        'name',
        'comment',
    ];
    
    //親DBを使うための記述
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
