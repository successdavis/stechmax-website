<?php

namespace Database\Factories;

use App\Paygrade;
use App\PaygradeHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaygradeHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PaygradeHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'emp_id'    => function() {
                return factory('App\User')->create()->id;
            },
            'paygrade_id' => function () {
                return Paygrade::factory()->create()->id;
            },
            'start_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
