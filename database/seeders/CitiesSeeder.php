<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Cities;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = new Faker;
        DB::table('cities')->insert([
            'name' => 'calicut',
            'lat' => '9.93123280',
            'lng' => '76.26730410',
            'status' => Cities::STATUS_ENABLED,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('cities')->insert([
            'name' => 'cochin',
            'lat' => '9.98266970',
            'lng' => '76.13611930',
            'status' => Cities::STATUS_ENABLED,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('cities')->insert([
            'name' => 'Kannur',
            'lat' => '11.86668560',
            'lng' => '75.34926320',
            'status' => Cities::STATUS_ENABLED,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('cities')->insert([
            'name' => 'delhi',
            'lat' => '28.64428740',
            'lng' => '76.76357020',
            'status' => Cities::STATUS_ENABLED,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        DB::table('cities')->insert([
            'name' => 'Ernamkulam',
            'lat' => '9.98266970',
            'lng' => '76.13611930',
            'status' => Cities::STATUS_ENABLED,
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}
