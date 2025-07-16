<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function simpleMap()
    {
        return view('leafletjs.simple-map');
    }

    public function marker()
    {
        return view('leafletjs.marker');
    }

    public function circle()
    {
        return view('leafletjs.circle');
    }

    public function polygon()
    {
        return view('leafletjs.polygon');
    }

    public function polyline()
    {
        return view('leafletjs.polyline');
    }

    public function rectangle()
    {
        return view('leafletjs.rectangle');
    }
}
