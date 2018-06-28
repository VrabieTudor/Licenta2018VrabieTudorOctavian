<?php

namespace App\Http\Controllers;

use App\Airline;
use App\Http\Transformers\FlightSearchTransformer;
use App\Services\FlightService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FlightSearchController extends ApiController {
    public function index(Request $request, FlightService $service, FlightSearchTransformer $transformer) {
        $params = [
            "flyFrom" => $request->input('from'),
            "to" => $request->input('to'),
            "dateFrom" => Carbon::parse($request->input('fromDate'))->format('d/m/Y'),
            "dateTo" => Carbon::parse($request->input('fromDate'))->format('d/m/Y'),
            "partner" => "picky",
            'adults' => $request->input('passengers', 1),
            'children' => $request->input('children', 0),
            "directFlights" => $request->input('withConnections', 0),
            "maxstopovers" => $request->input('maxstopovers', 10),
            "stopoverto" => $request->input('duration', "48:00"),
            'typeFlight' => $request->input('typeFlight', 'round'),
            "price_to" => $request->input("price_to", 1000),
            "limit" => 10
        ];
        if($request->input('typeFlight', 'round') === 'round') {
            $params["returnTo"] = Carbon::parse($request->input('toDate'))->format('d/m/Y');
            $params["returnFrom"] = Carbon::parse($request->input('toDate'))->format('d/m/Y');
        }
        $data = $service->getFlights($params);
        return $this->item($data, $transformer);
    }
}
