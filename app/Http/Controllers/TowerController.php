<?php

namespace App\Http\Controllers;

use App\Models\Tower;
use Auth;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Log;
use Mockery\Exception;

class TowerController extends Controller
{
	public function singleTower($tower_name)
	{
		$tower = Auth::user()->towers->where('name',$tower_name)->first();

		return view('app.tower', compact('tower','tower_name'));
	}

	public function newTowerView()
	{
		return view('app.add-tower');
	}

	public function createTower(Request $request)
	{
		$request->validate([
			'tower_name' => 'required|string'
		]);

		$status = fake()->numberBetween(1,5);
		$tower_name = $request['tower_name'];

		try {
			Tower::create([
				'name' 		=> $tower_name,
				'status' 	=> $status,
				'user_id' 	=> Auth::id(),
			]);
		}
		catch(UniqueConstraintViolationException) {
			return redirect()->back()->withErrors(['error' => 'This tower already exists.']);
		}


		Log::info("Successfully created tower $tower_name.");

		return redirect()->route('dashboard');

	}
}
