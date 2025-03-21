<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use App\Enums\City;

class WeatherController extends Controller
{
    protected $weatherService;

    public function __construct(WeatherService $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function index(Request $request)
    {
        $cityName = $request->input('city', 'Tokyo');
        $city = City::from($cityName);
        $cityLocation = $city->getCoordinates();
        try {
            $weatherData = $this->weatherService->fetchWeatherData($cityLocation['latitude'], $cityLocation['longitude']);
        } catch (\Exception $e) {
            return redirect()->route('weather.index')->with('error', '天気情報の取得に失敗しました。');
        }
        $cities = City::getAllCities();
        return view('weather.index', compact('weatherData', 'city', 'cities'));
    }

    // private function getCityLocation($city)
    // {
    //     $locations = [
    //         'Tokyo' => ['latitude' => 35.682839, 'longitude' => 139.759455],
    //         'Osaka' => ['latitude' => 34.693737, 'longitude' => 135.502165],
    //         'Sapporo' => ['latitude' => 43.062096, 'longitude' => 141.354376],
    //         'Fukuoka' => ['latitude' => 33.590354, 'longitude' => 130.401716],
    //         'Nagoya' => ['latitude' => 35.181472, 'longitude' => 136.906586],
    //         'Naha' => ['latitude' => 26.212401, 'longitude' => 127.680932],
    //     ];
    //     return $locations[$city];
    // }
}

