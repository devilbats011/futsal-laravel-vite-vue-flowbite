<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Str;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $length = 5;
        for ($i = 1; $i < $length; $i++) {
            if(Court::Where('number',$i)->first()) {
                $length +=5;
                continue;
            }

            DB::table('courts')->insert([
                'number' => $i,
                'type_floor' => $i % 2 == 0 ? 'Grass' : 'Cement',
                'hour_rate' => $i % 2 == 0 ? 70 : 50,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
