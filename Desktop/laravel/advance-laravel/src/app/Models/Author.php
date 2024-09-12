<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  use HasFactory;
  //ファクトリを定義

  protected $fillable = ['name', 'age', 'nationality'];
//$fillableは変更可能

//staticは静的webの時に使う
//ファクトリのルルーを指定
public static $rules = array(
    'name' => 'required',//必須
    'age' => 'integer|min:0|max:150',//整数0才から150才まで
    'nationality' => 'required'//必須
  );
  //詳細をget
  public function getDetail()
  {
    $txt = 'ID:' . $this->id . ' ' . $this->name . '(' . $this->age .  '才' . ') ' . $this->nationality;
    return $txt; //Authorのid,nameなど取得してtxtに代入
  }
  public function book()
  {
    return $this->hasOne('App\Models\Book');
    //１対１の関係、主テーブル側から関連する従テーブルを１つ取り出すメソッド
  }
  public function books()
  {
    return $this->hasMany('App\Models\Book');
    //１対多の関係、主テーブルのレコードと関連する複数の従テーブルのレコードに関連付けを行う
  }
}

