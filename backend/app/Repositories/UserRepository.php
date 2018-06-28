<?php namespace App\Repositories;

use App\User;

class UserRepository extends Repository {
    function assignedModel() {
        return app(User::class);
    }
}