<?php

namespace Database\Factories;

use App\Department;
use App\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
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
            'name'          => $this->faker->name(),
            'department_id' => function (){
                return Department::factory()->create()->id;
            }
        ];
    }
}
