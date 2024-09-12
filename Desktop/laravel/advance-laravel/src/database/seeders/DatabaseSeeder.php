<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
//Authorのモデルを定義
use App\Models\Person;
//Personモデルを定義
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AuthorsTableSeeder::class);
        //AuthorsTableSeeのクラスを呼び出す、登録するメソッド
        Author::factory(10)->create();
        //Authorテーブルのファクトリを１０個ダミーで作成するという意味
        Person::factory(10)->create();
        //personテーブルのダミーデータを１０個作るという定義
        Product::factory(10)->create();
    }

}
