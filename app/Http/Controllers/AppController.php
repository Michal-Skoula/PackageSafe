<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Auth;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
	{
		$towers = Auth::user()->towers()->orderBy('status')->paginate(30);

		return view('app.dashboard', compact('towers'));
	}
	public function tower($tower_name)
	{
		$tower = Auth::user()->towers->where('name',$tower_name)->first();

		return view('app.tower', compact('tower','tower_name'));
	}
}
