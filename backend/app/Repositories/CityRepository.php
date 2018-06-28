<?php namespace App\Repositories;

use App\Airport;
use App\City;

class CityRepository extends Repository {
    function assignedModel() {
        return app(City::class);
    }
    public function getCities($request) {
        $cities = Airport::where('city', 'like' , '%'. $request->input('search', null).'%')
            ->whereNotNull('name')
            ->select('city', 'code')
            ->get();
        return $cities;
    }
}