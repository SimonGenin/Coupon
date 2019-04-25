<?php

namespace App\Http\Controllers;

use App\Announcement;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $announcements = Announcement::all();

        $announcements = $announcements->filter(function ($value, $key) {
            return $value->distance > $value->owner->distance_from_user;
        });

        return view('home', compact('announcements'));
    }
}
