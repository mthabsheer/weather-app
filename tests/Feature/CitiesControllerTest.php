<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Cities;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CitiesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_show_single_city_forecast(): void
    {

        config(['services.openweather.api_key' => 'test']);

        Http::fake([
            config('services.openweather.base_url') . '/data/2.5/forecast?*'
            => Http::response(
                json_decode(file_get_contents('tests/stubs/response_single_city_200.json'), true),
                200
            )
        ]);

        Cities::create([
            'name' => 'c ochin',
            'lat' => '40.8198627',
            'lng' => '2.119459',
            'status' => Cities::STATUS_ENABLED
        ]);

        $response = $this->json('GET', '/api/cities/name/c ochin');

        $this->assertDatabaseHas('cities', [
            'name' => 'c ochin',
        ]);

        $response->assertJsonStructure([
            'common_data',
            'data' => [
                'name',
                'weather_data' => [
                    'list',
                    'row_count'
                ],
            ],
            'message',
        ]);


        $response->assertStatus(200);
    }

    public function test_list_all_city_forecast_with_pagination(): void
    {

        config(['services.openweather.api_key' => 'test']);

        Http::fake([
            config('services.openweather.base_url') . '/data/2.5/forecast?*'
            => Http::response(
                json_decode(file_get_contents('tests/stubs/response_single_city_200.json'), true),
                200
            )
        ]);

        Cities::factory(10)->create();

        $response = $this->json('GET', '/api/cities');

        $response->assertJsonStructure([
            'common_data',
            'data' => [
                'data' => [
                    '*' => [
                        'name',
                        'weather_data' => [
                            'list',
                            'row_count'
                        ],
                    ],
                ],
                'current_item_count',
                'next_page_links',
                'previous_page_links'
            ],
            'message',
        ]);


        $response->assertStatus(200);
    }
}
