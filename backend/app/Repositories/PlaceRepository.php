<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 6/11/2018
 * Time: 11:29 AM
 */

namespace App\Repositories;


class PlaceRepository {
private $appUrl = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';
    private $client;
    private $request;

    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }
    public function search($params) {
        $request = new \GuzzleHttp\Psr7\Request('GET', $this->appUrl);
        $promise = $this->client->sendAsync($request,  [
            'query' => $params
        ])->then(function ($response) use (&$data) {
            $data = json_decode($response->getBody()->getContents());
        });
        $promise->wait();
        $data->initialLat = $params['lat'];
        $data->initialLng = $params['lng'];
        return $data;
    }

}