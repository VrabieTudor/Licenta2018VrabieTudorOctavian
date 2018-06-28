<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class UserPermissionTransformer extends TransformerAbstract {
    protected $availableIncludes = [];

    public function transform($data) {
        return [
            "id" => $data["id"],
            "created_at" => $data["created_at"],
            "updated_at" => $data["updated_at"],
			"entity" => $data["entity"],
			"label" => $data["label"],
			"user_type_id" => $data["user_type_id"]
        ];
    }


}