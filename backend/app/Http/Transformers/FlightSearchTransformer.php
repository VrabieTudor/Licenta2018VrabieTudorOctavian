<?php namespace App\Http\Transformers;

use App\Airline;
use App\Airport;
use App\City;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class FlightSearchTransformer extends TransformerAbstract {
    protected $availableIncludes = [];
    private $maxRoutes;
    public function transform($data) {
        return [
            'currency' => $data->currency,
            'seats' => $data->search_params->seats,
            'flights' => $this->formatFlights($data->data),
            'maxRoutes' => $this->maxRoutes
        ];
    }
    public function formatFlights($data) {
        $flightsArray = [];
        $maxRoutes = 0;
        foreach ($data as $item) {
            $routeArray = [];
            $goingRoutes = [];
            $returnRoutes = [];
            $goingFinished = false;
            $maxRoutes = count($item->route) > $maxRoutes ? count($item->route) : $maxRoutes;
            foreach ($item->route as $index => $route) {
                $generatedArray = [
                    "bags_recheck_required" => $route->bags_recheck_required,
                    "mapIdfrom" => $route->mapIdfrom,
                    "flight_no" => $route->flight_no,
                    "original_return" => $route->original_return,
                    "lngFrom" => $route->lngFrom,
                    "flyTo" => $route->flyTo,
                    "guarantee" => $route->guarantee,
                    "mapIdto" => $route->mapIdto,
                    "source" => $route->source,
                    "combination_id" => $route->combination_id,
                    "id" => $route->id,
                    "latFrom" => $route->latFrom,
                    "lngTo" => $route->lngTo,
                    "aTimeUTC" => $route->aTimeUTC,
                    "refresh_timestamp" => $route->refresh_timestamp,
                    "return" => $route->return,
                    "price" => $route->price,
                    "cityTo" => $route->cityTo,
                    "vehicle_type" => $route->vehicle_type,
                    "flyFrom" => $route->flyFrom,
                    "dTimeUTC" => $route->dTimeUTC,
                    "latTo" => $route->latTo,
                    "dTime" => $route->dTime,
                    "found_on" => $route->found_on,
                    "airline" => Airline::where('iata', $route->airline)->first(),
                    "cityFrom" => $route->cityFrom,
                    "aTime" => $route->aTime,
                    'from_city' => City::where('name', $route->cityFrom)->first(),
                    'to_city' => City::where('name', $route->cityTo)->first(),
                    'from_airport' => Airport::where('code', $route->flyFrom)->first(),
                    'to_airport' => Airport::where('code', $route->flyTo)->first(),
                    'fly_duration' => date("H:i", ($route->aTimeUTC- $route->dTimeUTC)),
                    'departure_date' => date("H:i", ($route->dTimeUTC)),
                    'arrival_date' => date("H:i", ($route->aTimeUTC)),
                    'flight_date' => date("Y-m-d", ($route->dTimeUTC))
                ];
                if(!$goingFinished) {

                    $goingRoutes[] = $generatedArray;
                } else {
                    $returnRoutes[] = $generatedArray;
                }
                if($route->flyTo === $item->flyTo) {
                    $goingFinished = true;
                }
            }
            $flight = [
                'arrival_time' => date("Y-m-d H:i:s", $item->aTimeUTC),
                'price' => $item->conversion,
                'duration' => $item->duration->total / 60,
                'airlines' => Airline::where('iata', $item->airlines[0])->first(),
                'departure_time' => date("Y-m-d H:i:s", $item->dTimeUTC),
                'fly_duration' => $item->fly_duration,
                'link' => $item->deep_link,
                'going' => $goingRoutes,
                'fromCity' => $item->cityFrom,
                'toCity' => $item->cityTo,
                'fromAirport' => $item->flyFrom,
                'toAirport' => $item->flyTo,
                'returning' => $returnRoutes
            ];
            $flightsArray[] = $flight;

        }
        $this->maxRoutes = $maxRoutes;
        return $flightsArray;
    }


}