<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//消去を反映させるために定義

class Person extends Model
{
    //use HasFactory;
    use SoftDeletes;
    // SoftDeletes(消去)を定義
    protected $fillable = ['name', 'age'];
    //$fillableは変更可能を定義する
    use HasFactory;
}
