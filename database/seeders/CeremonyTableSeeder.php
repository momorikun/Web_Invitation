<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CeremonyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 50; $i++) {
            DB::table('ceremonies')->insert([
                'ceremony_id'   => 'test'.$i,
                'groom_name'    => 'groom'.$i,
                'bride_name'    => 'bride'.$i,
                'place_name'    => 'place'.$i,
                'address'       => 'address'.$i,
            ]);
        }
    }
}
