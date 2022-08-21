<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
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
        $relations = ['両親', '祖父母', '姉弟', '子供', '親戚', '友人', '上司', '同僚', '部下',];
        $genders = ['男性', '女性', 'その他'];

        //  2つの日付の間のランダム日を生成する
        $start = Carbon::create('2015', '1', '1');
        $end = Carbon::create('2020', '12', '31');
 
        // timestampに変換する
        $min = strtotime($start);
        $max = strtotime($end);
 
        DB::table('users')->insert([
            'name' => 'master',
            'kana' => 'マスター',
            'email'=> 'master@test.com',
            'password'=>Hash::make('master'),
            'user_categories_id' => 0,
            
            'is_answered' => 0,
            
            'uuid' => Str::uuid(),
        ]);

        DB::table('users')->insert([
            'name' => 'bride',
            'kana' => 'ブライド',
            'email'=> 'bride@test.com',
            'password'=>Hash::make('bride'),
            'user_categories_id' => 1,
            'ceremonies_id' => 'mori_no_ceremony',
            'is_answered' => 0,
            'plan_to_attend' => 0,
            'is_attended' => 0,
            'gift_money' => 0,
            'uuid' => Str::uuid(),
        ]);

        for ($i = 1; $i <= 10; $i++) {
            // ランダムなtimestampを取得し、フォーマット設定
            $date = rand($min, $max);
            $date = date('Y-m-d', $date);
            DB::table('users')->insert([
                'name' => 'test'.$i,
                'kana' => 'テスト'.$i,
                'gender'=> array_rand($genders),
                'is_bride_side' => mt_rand(0, 1),
                'relationship' => array_rand($relations),
                'email' => 'test'.$i.'@test.com',
                'password'=> Hash::make('test'.$i),
                'user_categories_id' => 2,
                'ceremonies_id' => 'mori_no_ceremony',
                'is_answered' => 0,
                'plan_to_attend' => 0,
                'is_attended' => 0,
                'gift_money' => 0,
                'uuid' => Str::uuid(),
            ]);
        }

        for ($j = 11; $i <= 20; $i++) {
            DB::table('users')->insert([
                'name' => 'test'.$i,
                'kana' => 'テスト'.$i,
                'gender'=> array_rand($genders),
                'is_bride_side' => mt_rand(0, 1),
                'relationship' => array_rand($relations),
                'email' => 'test'.$i.'@test.com',
                'password'=> Hash::make('test'.$i),
                'user_categories_id' => 2,
                'ceremonies_id' => 'mori_no_ceremony',
                'is_answered' => 1,
                'plan_to_attend' => 1,
                'is_attended' => mt_rand(0, 1),
                'gift_money' => 0,
                'uuid' => Str::uuid(),
            ]);
        }
    }
}
