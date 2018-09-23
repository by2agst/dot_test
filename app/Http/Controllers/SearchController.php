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
			if (env('data_from') == 'rajaongkir') {
				$qs      = @$req['id'] ? '?'. http_build_query($req) : '';
				$url     = 'https://api.rajaongkir.com/starter/province'.$qs;
				$headers = ['cache-control: no-cache', 'key: '.env('app_ro_key')];
				$curl    = custom_curl($url, $headers);

				if($curl['error']){
					throw $curl['error'];
				}

				$response = json_decode($curl['response']);
				if(@$response->rajaongkir->status->code !== 200) {
					throw new Exception('failed');
				}

				$response = $response->rajaongkir->results;
			} else {
				if (@$req['id']) {
					$response = Province::find($req['id']);
				} else {
					$response = Province::get();
				}
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
			if (env('data_from') == 'rajaongkir') {
				$qs      = @$req['id'] ? '?'. http_build_query($req) : '';
				$url     = 'https://api.rajaongkir.com/starter/cities'.$qs;
				$headers = ['cache-control: no-cache', 'key: '.env('app_ro_key')];
				$curl    = custom_curl($url, $headers);

				if($curl['error']){
					throw $curl['error'];
				}

				$response = json_decode($curl['response']);
				if(@$response->rajaongkir->status->code !== 200) {
					throw new Exception('failed');
				}

				$response = $response->rajaongkir->results;
			} else {
				if (@$req['id']) {
					$response = City::find($req['id']);
				} else {
					$response = City::get();
				}
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
