<?php

namespace Database\Factories;

use App\Jobtitle;
use App\Paygrade;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaygradeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Paygrade::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->name(),
            'bonus'         => 2000,
            'short_name'    => $this->faker->name(),
            'basic'         => 5000,
            'dearness_bonus'=> 1000,
            'jobtitle_id'   => function () {
                return Jobtitle::factory()->create();
            }
        ];
    }
}
