<?php

namespace Database\Factories;

use App\Payroll;
use Illuminate\Database\Eloquent\Factories\Factory;

class PayrollFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payroll::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status'        => 1,
            'gross_salary'  => 5000,
            'net_salary'    => 5000,
            'emp_id'        => function () {
                return factory('App\User')->create()->id;
            },
            'month'         => 'April',
            'year'          => '2021',
        ];
    }
}
