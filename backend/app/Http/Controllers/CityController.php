<?php

namespace App\Http\Controllers;

use App\Airport;
use App\City;
use App\Http\Transformers\AirportTransformer;
use App\Http\Transformers\CityTransformer;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;

class CityController extends ApiController {
    public function index(Request $request, CityRepository $repository) {
     return $this->collection($repository->getCities($request), new AirportTransformer());
    }
}
