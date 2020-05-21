<?php

namespace App\Http\Controllers\Admin;

class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function reservations()
    {
        return view('admin.reservations.index');
    }

    public function reserve() {
    	return view('admin.reservations.reserve');
    }

    public function recepti() {
        return view('admin.recepti');
    }

    public function pregledi() {
        return view('admin.pregledi');
    }
}
