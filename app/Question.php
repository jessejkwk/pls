<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions' ;

    public $timestamps = false ;

    protected $dates = [
        'asked_at'
    ] ;


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id') ;
    }

    public function answers()
    {
        return $this->hasMany(Answer::class ) ;
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('asked_at' , 'desc') ;
    }



}
