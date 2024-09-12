<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book extends Model
{
    use HasFactory;

    protected $guarded = array('id');
    //$guarded(id)を書き換えできないようにしている
    //$fillableプロパティの逆


    public static $rules = array(
        'author_id' => 'required',
        'title' => 'required',
    );
    //モデルのバリデーションルールを決めている
    //author_idとidは必須


    public function getTitle()
    {
        return 'ID'.$this->id . ':' . $this->title . ' 著者:' . optional($this->author)->name;
    }
    //モデルのidとtitleプロパティを含む文字列を返す

    public function author(){
        return $this->belongsTo('App\Models\Author');
    }
}
