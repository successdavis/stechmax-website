<?php

namespace Database\Factories;

use App\JobTitleHistory;
use App\Jobtitle;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobtitleHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JobTitleHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'jobtitle_id' => function() {
                return Jobtitle::factory()->create()->id;
            },
            'emp_id' => function() {
                return factory('App\User')->create()->id;
            },
            'start_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
