<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User_doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDoctorController extends Controller
{
    public function addUserDoctor (Request $request) {
//        abort_unless(\Gate::allows('user_create'), 403);
        $doctorId = $request->get('docId');
        $workplace = $request->get('workplace');
        $newDoctor = new User_doctor;
        $newDoctor->user_id = Auth::id();
        $newDoctor->doctor_id = $doctorId;
        $newDoctor->workspace = $workplace;
        $newDoctor->save();

        return 'AAA!';
    }

    public function showUserDoctor (Request $request) {
        $doctors = User_doctor::where('user_id', Auth::id())->get();
        return $doctors;
    }
}
