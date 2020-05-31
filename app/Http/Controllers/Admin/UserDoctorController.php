<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User_doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDoctorController extends Controller
{
    public function addUserDoctor (Request $request) {
//        abort_unless(\Gate::allows('user_create'), 403);
        $user_doctor_exists = User_doctor::where('user_id',Auth::id())->where('doctor_id',$request->get('docId'))->count();
        if($user_doctor_exists > 0) {
            return 'exists';
        }
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

    public function getWorkplaceForDoctor(Request $request) {
        // DB::enableQueryLog();
        $workplace = User_doctor::where('user_id', Auth::id())->where('doctor_id',$request->request->get('docId'))->get();
        // dd(DB::getQueryLog());
        if($workplace->count() < 1) {
            return 'fail';
        }

        return $workplace;
    }

    public function deleteDoctor (Request $request) {
        User_doctor::where('user_id',Auth::id())->where('doctor_id',$request->request->get('docId'))->delete();
        return 'OK';
    }
}
