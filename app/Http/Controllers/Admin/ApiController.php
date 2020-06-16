<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // TODO: change this in production
    /**
     *
     * Zdej delaš klice na api v tem controllerju z Guzzlom, tale prva dva delata uredu, in sijih že na home page tudi prestavil.
     *
     * Najprej spremeni še vse ostale get api klice na ta način pol pa probi še poste sepravi dejanskerezervacije terminov.
     *
     */
    public $api = "https://durs.comtrade.com/ctNarocanje"; //https://enarocanje-gw1.comtrade.com/ctNarocanjeTest
//    public $api = "https://enarocanje-gw1.comtrade.com/ctNarocanjeTest";

    public function getDoctors(){
        $endpoint = $this->api . "/api/ElektronskoNarocanje/GetDoctors?request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:75.0) Gecko/20100101 Firefox/75.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint, ['verify' => false]);

        return json_decode($response->getBody(), true);
    }

    public function getDoctorsInfo(Request $request){
        $selectedDoctorsId = $request->get('selectedDoctorsId');
        $endpoint = $this->api . "/api/ElektronskoNarocanje/GetDoctorInfo?request.doctorIVZCode=" . $selectedDoctorsId . "&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:75.0) Gecko/20100101 Firefox/75.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint, ['verify' => false]);

        return json_decode($response->getBody(), true);
    }

    public function getFreeSlots(Request $request){
        $workplaceOfselectedDoctor = $request->get('workplace');
        $docId = $request->get('selectedDoctorsId');
        $endpoint = $this->api . "/api/ElektronskoNarocanje/GetFreeSlots?request.workplaceCode=" . $workplaceOfselectedDoctor . "&request.doctorIVZCode=" . $docId . "&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=browser (User-Agent): Mozilla/5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint, ['verify' => false]);

        return json_decode($response->getBody(), true);
    }
}
