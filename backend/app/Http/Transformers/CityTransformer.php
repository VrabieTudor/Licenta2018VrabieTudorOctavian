<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;

class CityTransformer extends TransformerAbstract {
    protected $availableIncludes = [];
    public function transform($data)
    {
        return [
            'id' => $data['id'],
            'name' => $data['name'],
            'region' => $data['region'],
            'country' => $data['country'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ];
    }
}