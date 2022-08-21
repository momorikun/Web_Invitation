<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $relationships = ['両親', '祖父母', '姉弟', '子供', '親戚', '友人', '上司', '同僚', '部下'];

        for($i = 0; $i < count($relationships); ++$i){
            DB::table('relationship')->insert([
                'relation_name' => $relationships[$i], 
            ]);
        }
        
    }
}
