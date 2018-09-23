<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\City;

class GetROCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getro:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get cities from rajaongkir';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $url = 'https://api.rajaongkir.com/starter/city';
            $headers = ['cache-control: no-cache', 'key: '.env('app_ro_key')];
            $curl = custom_curl($url, $headers);

            if($curl['error']){
                throw $curl['error'];
            }

            $response = json_decode($curl['response']);
            if(@$response->rajaongkir->status->code !== 200) {
                throw new Exception('failed');
            }

            foreach ($response->rajaongkir->results as $key => $value) {
                $this->info($value->city_id . ':' . $value->city_name);
                $data = City::updateOrCreate(['city_id' => $value->city_id, 'province_id' => $value->province_id], ['type' => $value->type, 'city_name' => $value->city_name, 'postal_code' => $value->postal_code]);
            }
            $this->info('>_ finished');
        } catch (\Exception $e) {
            $this->info($e->getMessage());
        }
    }
}
