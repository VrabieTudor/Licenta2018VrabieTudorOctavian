<?php

namespace App\Http\Controllers;

use App\Http\Transformers\PlaceTransformer;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;

class PlaceController extends ApiController {
    public function index(Request $request, PlaceRepository $repository, PlaceTransformer $transformer) {
        $params = [
            'key' => env('GOOGLE_KEY'),
            'location' => $request->input('lat').','.$request->input('lng'),
            'radius' => 30000,
            'keyword' => $request->input('keyword'),
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng')

        ];
        $data = $repository->search($params);
        return $this->item($data, $transformer);
    }
}
