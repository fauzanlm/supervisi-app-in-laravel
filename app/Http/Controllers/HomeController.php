<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        if (Auth::user()->role == 'guru') {
            return redirect()->route('guru.home');
        }
        else if (Auth::user()->role == 'kurikulum') {
            return redirect()->route('kurikulum.index');
        }
        else if (Auth::user()->role == 'kepsek') {
            return redirect()->route('kepsek.home');
        }
    }
}
