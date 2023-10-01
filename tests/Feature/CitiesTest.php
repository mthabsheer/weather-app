<?php

namespace Tests\Feature;

use App\Models\Cities;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class CitiesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A feature test for creating city success.
     */
    public function test_create_city_success(): void
    {
        $payload = ['name' => 'italy', 'lat' => '40.8198627', 'lng' => '2.119459'];

        $response = $this->post('/api/cities', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'common_data',
                'data' => [
                    'name',
                    'lat',
                    'lng',
                    'status',
                    'updated_at',
                    'created_at',
                    'id',
                ],
                'message',
            ]);


        $this->assertDatabaseHas('cities', $payload);

        //clearing the db
        // Cities::where('name', 'italy')->delete();
    }

    public function test_create_city_already_exist_error(): void
    {
        Cities::create([
            'name' => 'Ernamkulam',
            'lat' => '40.8198627',
            'lng' => '2.119459',
            'status' => Cities::STATUS_ENABLED
        ]);

        $payload = ['name' => 'italy', 'lat' => '40.8198627', 'lng' => '2.119459'];

        $response = $this->json('POST', '/api/cities', $payload);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'A city with this name already exists',
                'errors' => [
                    'name' => ['A city with this name already exists'],
                ]
            ]);
    }

    // public function test_view_single_city_forecast(): void
    // {
    //     Cities::create([
    //         'name' => 'cochin',
    //         'lat' => '40.8198627',
    //         'lng' => '2.119459',
    //         'status' => Cities::STATUS_ENABLED
    //     ]);

    //     $response = $this->json('GET', '/api/cities/name/cochin');

    //     $response->assertStatus(200)
    //         ->assertJsonStructure([
    //             'common_data',
    //             'data' => [
    //                 'name',
    //                 'weather_data' => [
    //                     'list' => [
    //                         '*' => [
    //                             'dt',
    //                             'main',
    //                             'weather',
    //                             'clouds',
    //                             'wind',
    //                             'visibility',
    //                             'pop',
    //                             'rain',
    //                             'sys',
    //                             'dt_txt'
    //                         ]
    //                     ],
    //                     'row_count'
    //                 ],
    //             ],
    //             'message',
    //         ]);
    // }
}
