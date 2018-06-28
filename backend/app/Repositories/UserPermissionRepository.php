<?php namespace App\Repositories;

use App\UserPermission;

class UserPermissionRepository extends Repository {
    function assignedModel() {
        return app(UserPermission::class);
    }
}