<?php namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use RFHaversini\Distance;

class PlaceTransformer extends TransformerAbstract {
    protected $availableIncludes = [];

    public function transform($data) {
        return $this->transformData($data);
    }
    public function transformData($data) {
        $returnData = [];
        $index = 0;
        foreach ($data->results as $result) {
            if($index === 6) {
                break;
            }
            $index++;
            $temporaryArray = [
                'name' => $result->name,
                'photo' => array_key_exists("photos", $result) !== false ? $this->getPhotoUrl($result->photos[0]->photo_reference) : null,
                'reference' => $result->reference,
                'types' => $result->types,
                'distance' => Distance::toKilometers($data->initialLat, $data->initialLat, $result->geometry->location->lat, $result->geometry->location->lat)
            ];
            $returnData[] = $temporaryArray;
        }
        return $returnData;
    }
    public function getPhotoUrl($reference) {
        $key = env('GOOGLE_KEY');
        return "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photoreference=$reference&key=$key";
    }
}