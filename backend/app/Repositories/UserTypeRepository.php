<?php namespace App\Repositories;

use App\UserType;

class UserTypeRepository extends Repository {
    function assignedModel() {
        return app(UserType::class);
    }
}