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
    //public $api = "https://durs.comtrade.com/ctNarocanje"; //https://enarocanje-gw1.comtrade.com/ctNarocanjeTest
    public $api = "https://enarocanje-gw1.comtrade.com/ctNarocanjeTest";

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

    public function getLabSlots(Request $request) {
        $labNumber = $request->get('labNumber');
        $endpoint = $this->api . "/api/ElektronskoNarocanje/GetFreeLabSlots?request.labOrderNumber=" . $labNumber . "&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=browser%20(User-Agent)%3A%20Mozilla%2F5.0&request.client.applicationVersion=1.22&request.client.applicationId=myXlife";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', $endpoint, [
                'verify' => false,
            ]
        );

        return json_decode($response->getBody(), true);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * curl -d '{ "Patient":{ "KzzNumber":"900001300", "Email":"test@test.com", "Phone":"031200334"}, "Slot":{ "SlotId":213854, "Start":"2020-06-22T07:20:00", "End":"2020-06-22T07:40:00" }, "Comment":"nekrandomtestnicomment", "Attachments":[], "WorkplaceCode":"2296", "DoctorIVZCode":"95400", "ProviderZZZSNumber":"102320", "Client":{ "UniqueDeviceId":"A3DE534DB","ClientType":"browser(User-Agent):Mozilla/5.0","ApplicationVersion":"1.22","ApplicationId":"myXlife"}}' -H "Content-Type: application/json" -X POST https://durs.comtrade.com/ctNarocanje/api/ElektronskoNarocanje/BookSlot -k
     *
     * tale curl ukaz vrne isSuccessfull true, tak da je vrjetn prav
     *
     */
    public function bookSlot(Request $request){
        $params = $request->get('params');
        // $params = array_merge($params);
        $headers = [
            'Content-Type' => 'application/json',
        ];
        $endpoint = $this->api . "/api/ElektronskoNarocanje/BookSlot";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $endpoint, [
            'verify' => false,
            //"headers" => $headers,
            "form_params" => $params,
            ]
        );

        return json_decode($response->getBody(), true);
    }

    public function cancelBookedSlot (Request $request) {
        $params = $request->get('params');
        $endpoint = $this->api . "/api/ElektronskoNarocanje/CancelSlotBooking";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $endpoint, [
                'verify' => false,
                //"headers" => $headers,
                "form_params" => $params,
            ]
        );

        return json_decode($response->getBody(), true);
    }


    public function requestPerscription(Request $request) {
        $params = $request->get('params');
        $endpoint = $this->api . "/api/ElektronskoNarocanje/RequestPrescription";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $endpoint, [
                'verify' => false,
                //"headers" => $headers,
                "form_params" => $params,
            ]
        );

        return json_decode($response->getBody(), true);
    }

    public function cancelPerscription(Request $request) {
        $params = $request->get('params');
        $endpoint = $this->api . "/api/ElektronskoNarocanje/CancelRequestedPrescription";
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', $endpoint, [
                'verify' => false,
                //"headers" => $headers,
                "form_params" => $params,
            ]
        );

        return json_decode($response->getBody(), true);
    }
}
