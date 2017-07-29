<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    public $timestamps = false ;


    protected $table = 'discussions' ;

    protected $dates = [
        'sent_at'
    ] ;

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id') ;
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class , 'topic_id') ;
    }


}
