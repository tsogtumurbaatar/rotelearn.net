<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scores = DB::table('users_score')
        ->where('user_id',auth::user()->id)
        ->orderby('id','desc')
        ->paginate(25);

        return view('home',[
            'scores' => $scores
            ]);
    }
}
