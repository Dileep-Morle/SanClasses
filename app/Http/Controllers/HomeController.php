<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
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
    public function about_us()
    {
        return view('about-us');
    }
    public function contact_us()
    {
        return view('contact-us');
    }
    public function portfolio()
    {
        return view('portfolio');
    }
    public function blog()
    {
        return view('blog');
    }
    public function carrers()
    {
        return view('carrers');
    }
}
