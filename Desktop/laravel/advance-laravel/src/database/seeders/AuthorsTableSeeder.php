<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Author;

class AuthorsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Author::factory()->count(3)->create();
  }
}
//Authorモデルを利用して Eloquent からファクトリを呼び出す
//countメソッドの引数で、データを作成する個数が決定