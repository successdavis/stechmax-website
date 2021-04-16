<?php

namespace Database\Factories;

use App\Department;
use App\Jobtitle;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobtitleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Jobtitle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'          => $this->faker->name(),
            'department_id' => function (){
                return Department::factory()->create()->id;
            }
        ];
    }
}
