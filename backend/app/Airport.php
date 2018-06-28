<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
protected $fillable = [
        "code",
        "latitude",
        "longitude" ,
        "name" ,
        "city" ,
        "state" ,
        "country" ,
        "woeid",
        "timezone",
        "phone",
        "type",
        "email",
        "url",
        "runway_length",
        "elev",
        "icao",
        "direct_flights",
        "carriers"
    ];
}
