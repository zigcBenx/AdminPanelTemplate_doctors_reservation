<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        $user = User::where('id',Auth::id())->get();
        return view('home')->with(compact('user'));
    }

    public function reservations()
    {
        return view('admin.reservations.index');
    }

    public function reserve() {
        $user = Auth::user();
    	return view('admin.reservations.reserve')->with(compact('user'));
    }

    public function recepti() {
        $user = Auth::user();
        return view('admin.recepti')->with(compact('user'));
    }

    public function pregledi() {//https://durs.comtrade.com/ctNarocanje
        $endpoint = "https://durs.comtrade.com/ctNarocanje/api/ElektronskoNarocanje/GetDoctors?request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:75.0) Gecko/20100101 Firefox/75.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint);

// url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();
        // json_decode($response->getBody(), true) // this return the same as
        return json_decode($response->getBody(), true)['Doctors'];
        //return view('admin.pregledi');
    }
}
