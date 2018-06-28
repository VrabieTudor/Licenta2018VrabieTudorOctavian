<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Airline extends Model
{
    protected $fillable = [
        "iata",
        "icao",
        "name",
        "company",
        "country"
    ];
}
