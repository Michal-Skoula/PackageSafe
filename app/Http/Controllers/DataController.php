<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Nette\Utils\Json;

class DataController extends Controller
{
	public function index()
	{
		$now = Carbon::now();
		$hour = $now->hour;
		$greeting = '';

		if($hour >= 6 && $hour < 10) {
			$greeting = 'Dobré ráno';
		} else if($hour >= 10 && $hour < 18) {
			$greeting = 'Dobrý den';
		} else {
			$greeting = 'Dobrý večer';
		}

		$devices = [
			[
				'device_id' => 1,
				'name' => 'Kancelář'
			],
			[
				'device_id' => 2,
				'name' => 'Zasedačka'
			]
		];

		return view('app.dashboard', compact('greeting', 'devices'));
//		return view('app.dashboard', compact($chart));
	}



	public function database() {
		$data = Data::paginate(100);

		return view('app.database', ['data' => $data]);
	}
	public function testEntry()
	{
//		$payload = json_encode(request()->all());
//		$response = '"{"topic":"node/push-button:0/orientation","payload":1}"';

		$body = typeof(request()->getContent());

		Log::info("$body");





		return response()->json(['content' => $body]);

	}
}
