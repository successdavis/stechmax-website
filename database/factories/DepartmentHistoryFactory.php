<?php

namespace Database\Factories;

use App\Department;
use App\DepartmentHistory;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DepartmentHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'emp_id'    => function(){
                return factory('App\User')->create()->id;
            },
            'department_id'    => function(){
                return Department::factory()->create()->id;
            },
            'start_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
