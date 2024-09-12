<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pen extends Model
{
    use HasFactory;
    protected $table = 'pens'; // 必要に応じて変更

    protected $guarded = ['id'];

    protected $fillable = ['name', 'uuid', 'price'];
}

//$guarded  指定したカラムに対して書き換えを不可能にする
//$fillable  指定したカラムに対して書き換え可能にする