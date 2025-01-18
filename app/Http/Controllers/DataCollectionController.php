<?php

namespace App\Http\Controllers;

use App\Models\DataTypes\Collision;
use App\Models\DataTypes\Humidity;
use App\Models\DataTypes\Rotation;
use App\Models\DataTypes\Temperature;
use App\Models\Day;
use App\Models\Tower;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Str;

class DataCollectionController extends Controller
{
	/**
	 * Get data from request - Example: "{"topic":"node/push-button:0/orientation","payload":1}"
 	 * @param  Request  $request
	 * @param  Tower  $tower Tower from which the request came from
	 * @return array|JsonResponse
	 */
	public function parseJSON(Request $request, Tower $tower) : array|JsonResponse
	{
		if($request->getContent() == null) {
			return response()->json([ 'error' => 'There was no content found in the HTTP request.' ]);
		}
		$request_content = $request->getContent();

		Log::debug("Request content: $request_content");

		$request_content_json = json_decode($request_content, true);
		$data_type = Str::afterLast($request_content_json['topic'], '/');
		$value = $request_content_json['payload'];

		if(!$data_type || !$value) {
			return response()->json(['error' => 'Invalid data format.']);
		}
		$parse_base64 = base64_decode($request_content);
		Log::debug("Parsed base64: $parse_base64");



		\Log::log('info', "Tower $tower->name Topic: $data_type, Value: $value");

		return [
			'data_type' => $data_type,
			'value' => $value
		];
	}

	public function ingest(int $id, Request $request) {
		$tower = Tower::find($id) ?? null;
		if($tower == null) {
			return response()->json([ 'error' => 'The specified tower does not exist.' ]);
		}

		$user_id = $tower->user_id;

		$json = $this->parseJSON($request, $tower);
		$data_type = $json['data_type'];
		$value = $json['value'];


		if(Day::isValidDataType($data_type) && isset($value)) {
			Log::log('info', "Data type is valid and value is set.");

			$today = now()->format('Y-m-d');

			if(! Day::todayEntryExists($data_type, $tower->id, $today)) {
				Log::log('info', "Today's entry doesn't exist, creating $data_type's entry for today.");

				Day::create([
					'tower_id' => $tower->id,
					'date' => $today,
					'data_type' => $data_type,
				]);
			}
			$current_day = Day::days($data_type, $tower->id, 1)->first();

			switch ($data_type) {
				case 'temperature':
					Temperature::create([
						'day_id' => $current_day->id,
						'temperature' => $value,
					]);
					break;
				case 'collision':
					Collision::create([
						'day_id' => $current_day->id,
						'collision' => $value,
					]);
					break;
				case 'rotation':
					// TODO: parse the three rotation values into variables to be added into the model.

					Rotation::create([
						'day_id' => $current_day->id,
						'rotation_x' => $value,
						'rotation_y' => $value,
						'rotation_z' => $value,
					]);
					break;
				case 'humidity':
					Humidity::create([
						'day_id' => $current_day->id,
						'humidity' => $value,
					]);
					break;
				default:
					return response()->json([ 'error' => 'Something went wrong when trying to add data to the database.' ]);
			}
		}
		else return response()->json([ 'error' => 'Invalid request.' ]);

		\Log::log('info', "Successfully ingested new entry into the database.");

		return response()->json([
			'message' => "Request type $data_type for tower $tower->name (id $tower->id) value $value stored successfully.",
			'data' => [
				'tower_id' 		=> $tower->id,
				'tower_name' 	=> $tower->name,
				'data_type' 	=> $data_type,
				'value' 		=> $value,
				'tower_owner' 	=> User::whereId($user_id)->first()->name,
			]
		]);

	}
}