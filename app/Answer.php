<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers' ;

    public $timestamps = false ;

    public function question()
    {
        return $this->belongsTo(Question::class ,'question_id') ;
    }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id') ;
    }

}
