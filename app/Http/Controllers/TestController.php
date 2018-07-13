<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;


class TestController extends Controller
{
    public function index() 
    {   

        $url = "http://api.football-data.org/v1/competitions/467/fixtures";
        
        $client = new Client(); //GuzzleHttp\Client
        $res = $client->request('GET', $url, [
            
            'headers' => [
                "accepts" => "json",
                "Accept" => "application/json"
            ],
            
        ]);
        

        $contents = collect(json_decode($res->getBody()->getContents()));
        collect($contents['fixtures'])->filter(function($fixture) {
            return $fixture->date == "2018-06-14T15:00:00Z";
        })->dump();
    }
}
