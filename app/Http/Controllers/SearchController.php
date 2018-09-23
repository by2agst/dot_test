<?php

namespace App\Http\Controllers;

use App\City;
use App\Province;
use Illuminate\Http\Request;
use Exception;

class SearchController extends Controller
{
	public function provinces(Request $request)
	{
		try {
			$req = $request->only('id');
			if (@$req['id']) {
				$response = Province::find($req['id']);
			} else {
				$response = Province::get();
			}

			if (!$response) {
				throw new Exception('data not found');
			}

			return response()->json($response);die;
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 404);
		}

	}

	public function cities(Request $request)
	{
		try {
			$req = $request->only('id');
			if (@$req['id']) {
				$response = City::find($req['id']);
			} else {
				$response = City::get();
			}

			if (!$response) {
				throw new Exception('data not found');
			}

			return response()->json($response);die;
		} catch (\Exception $e) {
			return response()->json(['message' => $e->getMessage()], 404);
		}

	}
}
