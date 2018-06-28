<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class UserTypeTransformer extends TransformerAbstract {
    protected $availableIncludes = [];

    public function transform($data) {
        return [
            "id" => $data["id"],
            "created_at" => $data["created_at"],
            "updated_at" => $data["updated_at"],
			"name" => $data["name"]
        ];
    }


}