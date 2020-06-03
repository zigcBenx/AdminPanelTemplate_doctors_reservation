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
        return view('admin.recepti');
    }

    public function pregledi() {
        return view('admin.pregledi');
    }
}
