<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
	{
		$towers = Auth::user()->towers()->orderBy('status')->get();

		return view('app.dashboard', compact('towers'));
	}
}
