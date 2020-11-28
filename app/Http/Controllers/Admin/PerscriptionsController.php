<?php

namespace App\Http\Controllers\Admin;

use App\Perscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class PerscriptionsController extends Controller
{
    public function addPerscription(Request $request){
        // TODO: check if this works
        $perscription = new Perscription();
        $perscription->requestId = $request->requestId;
        $perscription->userId = Auth::id();
        $perscription->workplaceCode = $request->workplace_id;
        $perscription->comment = $request->comment;
        $perscription->doctorIVZCode = $request->doctorCode ;
        $perscription->requestTime = Carbon::now();
        $perscription->canceled = false;

        $perscription->save();

        return 'nojs';
    }

    /**
     * This just set reservation as canceled
     * @param Request $request
     * @throws \Exception
     */
    public function removePerscription(Request $request) {
        $perscriptionToDelete = $request->get('id');
        Perscription::where('id', $perscriptionToDelete)
            ->update(['canceled' => 1]);

        return 'OK';
    }
}
