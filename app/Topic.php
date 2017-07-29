<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $timestamps = false ;

    public $table = 'topics' ;

    public function discussions()
    {
        return $this->hasMany(Discussion::class) ;
    }

}
