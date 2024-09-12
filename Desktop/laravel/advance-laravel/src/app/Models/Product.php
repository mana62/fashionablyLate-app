<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'uuid',
    ];

    protected $hidden =[
        'id', 'created_at', 'updated_at',
    ];
    use HasFactory;
}
//$fillableと$hiddenの設定で表示、非表示の設定を切り替えることが可能