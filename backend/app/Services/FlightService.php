<?php
/**
 * Created by PhpStorm.
 * User: Tudor
 * Date: 5/12/2018
 * Time: 4:01 PM
 */
namespace App\Services;

class FlightService {
    private $appUrl = 'https://api.skypicker.com/flights';
    private $client;
    private $request;
    public function __construct() {
        $this->client = new \GuzzleHttp\Client();
    }
     public function getFlights($params) {
         $request = new \GuzzleHttp\Psr7\Request('GET', $this->appUrl);
         $promise = $this->client->sendAsync($request,  [
             'query' => $params
         ])->then(function ($response) use (&$data) {
             $data = json_decode($response->getBody()->getContents());
         });
         $promise->wait();
         return $data;
     }
}