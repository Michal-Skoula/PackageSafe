<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Tower;
use Auth;
use Illuminate\Http\Request;

class AppController extends Controller
{
	public function index()
	{
		return view('app.index');
	}
    public function dashboard()
	{
		$towers = Auth::user()->towers()->orderBy('status')->paginate(30);

		return view('app.dashboard', compact('towers'));
	}
	public function database() {
		$data = Data::paginate(100);

		return view('app.database', ['data' => $data]);
	}
}
