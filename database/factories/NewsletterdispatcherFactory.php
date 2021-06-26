<?php

namespace Database\Factories;

use App\Newsletter;
use App\Newsletterdispatcher;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsletterdispatcherFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Newsletterdispatcher::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'newsletter_id'   => function() {
                return Newsletter::factory()->create()->id;
            },
            'dispatcher_id' => 1,
            'dispatcher_type' => 'App\User',
            'status'           => true,
        ];
    }
}
