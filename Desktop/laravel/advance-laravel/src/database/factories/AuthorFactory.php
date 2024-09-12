<?php

namespace Database\Factories;

//ファクトリをするモデルを定義
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class AuthorFactory extends Factory
{

    /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
    protected $model = Author::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    //definition()メソッドの中の [] のなかにデータの定義をしていく
    //definitionは定義という意味
    {
        return [
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(1,100),
            'nationality' => $this->faker->country(),
        ];
    }
}
//fakerメソッドを用いて、name、age、nationalityの３つのカラムに対して、ランダムデータを作成するように記述
//fakerメソッドは、自動的にデータを作成してくれる部品