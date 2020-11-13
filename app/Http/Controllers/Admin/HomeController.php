<?php

namespace App\Http\Controllers\Admin;

use App\Reservations;
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

    public function pregledi() {
        $reservations = Reservations::all()->where('user_id', Auth::id())->sortByDesc('start');

        return view('admin.pregledi')->with(compact('reservations'));
    }

    public function lab() {

        return view('admin.lab');
    }
}
