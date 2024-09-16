<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Facades\DB;
use Carbon\Carbon;


class GradesTableSeeder extends Seeder
{
    public function run()
    {
        //gradeテーブルへの事前登録データ
        $grades = [
            ['name' => '小学校1年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '小学校2年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '小学校3年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '小学校4年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '小学校5年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '小学校6年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '中学校1年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '中学校2年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '中学校3年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '高校1年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '高校2年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
            ['name' => '高校3年生', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ],
        ];
    
        DB::table('grades')->insert($grades);
    }
}
