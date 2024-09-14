<?php

namespace Database\Factories;

use App\Models\Curriculum;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curriculum>
 */
class CurriculumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Curriculum::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'education', true),
            'description' => $this->faker->paragraphs(3, true),
            'video_url' => $this->faker->url,
            'always_delivery_flg' => $this->faker->boolean,
            'grade_id' => $this->faker->randomElement(Grade::pluck('id')->toArray()),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
