<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curriculum;
use App\Models\Banner;
use App\Models\Grade;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Banner の生成
        Banner::factory(3)->create();

        // Grade の生成
        $this->call([
            GradeSeeder::class,
        ]);

        // 既存の Grade の id を取得
        $gradeIds = Grade::pluck('id')->toArray();

        // Faker インスタンスを作成
        $faker = Faker::create();

        // Curriculum の生成
        Curriculum::factory()->count(40)->create(function () use ($gradeIds, $faker) {
            return ['grade_id' => $faker->randomElement($gradeIds)];
        });
    }
}
