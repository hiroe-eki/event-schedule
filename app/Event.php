<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Schedule; //ここを記述
use App\Guest; //ここを記述

class Event extends Model
{
    protected $fillable = [
        'id',
        'name',
        'caption',
        'token',
    ];
    
    //子DBを使うための記述
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    
    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}