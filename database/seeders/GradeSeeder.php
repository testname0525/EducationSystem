<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder 
{
    public function run()
    {
        $grades = [
            ['name' => '初級'],
            ['name' => '中級'],
            ['name' => '上級'],
        ];

        foreach ($grades as $grade) {
            Grade::create($grade);
        }
    }
}