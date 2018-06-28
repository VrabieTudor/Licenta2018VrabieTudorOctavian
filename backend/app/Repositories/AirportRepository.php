<?php namespace App\Repositories;

use App\Airport;

class AirportRepository extends Repository {
    function assignedModel() {
        return app(Airport::class);
    }
}