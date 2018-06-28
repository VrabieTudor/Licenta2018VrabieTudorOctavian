<?php namespace App\Repositories;

use App\File;

class FileRepository extends Repository {
    function assignedModel() {
        return app(File::class);
    }
}