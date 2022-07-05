<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  2つの日付の間のランダム日を生成する
        $start = Carbon::create("2015", "1", "1");
        $end = Carbon::create("2020", "12", "31");
 
        // timestampに変換する
        $min = strtotime($start);
        $max = strtotime($end);
 
        for ($i = 1; $i <= 10; $i++) {
            // ランダムなtimestampを取得し、フォーマット設定
            $date = rand($min, $max);
            $date = date('Y-m-d', $date);
 
            DB::table('users')->insert([
                'name' => Str::random(10),
                'kana' => Str::random(10),
                'email' => Str::random(10).'@test.com',
                'password'=> Str::random(10),
                'user_categories_id' => 2,
                'ceremonies_id' => 'mori_no_ceremony',
                'is_answered' => 0,
                'plan_to_attend' => 0,
                'is_attended' => 0,
                'gift_money' => 0,
                'uuid' => Str::uuid(),
            ]);
        }
    }
}
