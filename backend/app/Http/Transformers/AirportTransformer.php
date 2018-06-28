<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class AirportTransformer extends TransformerAbstract {
    protected $availableIncludes = [];
    public function transform($data)
    {
        return [
            "id" => $data["id"],
            "code" => $data["code"],
            "latitude" => $data["latitude"],
            "longitude"  => $data["longitude" ],
            "name"  => $data["name" ],
            "city"  => $data["city" ],
            "state"  => $data["state" ],
            "country"  => $data["country" ],
            "woeid" => $data["woeid"],
            "timezone" => $data["timezone"],
            "phone" => $data["phone"],
            "type" => $data["type"],
            "email" => $data["email"],
            "url" => $data["url"],
            "runway_length" => $data["runway_length"],
            "elev" => $data["elev"],
            "icao" => $data["icao"],
            "direct_flights" => $data["direct_flights"],
            "carriers" => $data["carriers"],
        ];
    }
}