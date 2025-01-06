<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class DataController extends Controller
{
	public function index()
	{
		$now = Carbon::now();
		$hour = $now->hour;
		$greeting = '';

		if($hour >= 6 && $hour < 10) {
			$greeting = 'Dobré ráno';
		}
		else if($hour >= 10 && $hour < 18) {
			$greeting = 'Dobrý den';
		}
		else {
			$greeting = 'Dobrý večer';
		}


		return view('dashboard', [
			'greeting' => $greeting
		]);
	}
	public function database() {
		return 'TODO: table view lol';
	}

}
