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
        $reservation->slotId = $request->get('params.Slot.SlotId');
        $reservation->user_id = Auth::id();
        $reservation->workplace_id = $request->get('params.WorkplaceCode');
        $reservation->start = $request->get('params.Slot.Start');
        $reservation->end = $request->get('params.Slot.End');
        $reservation->canceled = false;

        $reservation->save();

        return 'nojs';
    }
}
