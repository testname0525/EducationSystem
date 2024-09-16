<?php

namespace Database\Factories;

use App\Models\DeliveryTime;
use App\Models\Curriculum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DeliveryTime>
 */
class DeliveryTimeFactory extends Factory
{
    protected $model = DeliveryTime::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $curriculum = Curriculum::inRandomOrder()->first();
        $from = $this->faker->dateTimeBetween('now', '+1 month');
        $to = $this->faker->dateTimeBetween($from, $from->format('Y-m-d H:i:s').' +7 days');

        return [
            'curriculums_id' => $curriculum->id,
            'delivery_from' => $from,
            'delivery_to' => $to,
        ];
    }
}
