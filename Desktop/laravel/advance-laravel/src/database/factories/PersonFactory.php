<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
//Models\Personを反映させるために定義

class PersonFactory extends Factory
{
    protected $model = Person::class;
    //$modelというプロパティにPersonクラスを設定
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(1,100),
        ];
    }
}
