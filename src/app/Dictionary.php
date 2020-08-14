<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $fillable = [
        'ask', 'ans','type'
    ];

    public static function getReply($msg)
    {
        $res = Dictionary::where('ask', $msg)->get();
        if (count($res) === 0) $res = null;
        return $res;
    }
}  //

