<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Reservations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    public function createReservation(Request $request){
        $reservation = new Reservations();
        $reservation->slotId = $request->slotId;
        $reservation->user_id = Auth::id();
        $reservation->workplace_id = $request->workplace_id;
        $reservation->start = $request->start;
        $reservation->end = $request->end;
        $reservation->canceled = false;

        $reservation->save();

        return 'nojs';
    }

    /**
     * This just set reservation as canceled
     * @param Request $request
     * @throws \Exception
     */
    public function deleteReservation(Request $request) {
        $reservationToDelete = $request->get('id');
        Reservations::where('id', $reservationToDelete)
            ->update(['canceled' => 1]);

        return 'OK';
    }
}
