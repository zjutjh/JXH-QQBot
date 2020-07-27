<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $fillable = [
        'request_type', 'sub_type','group_id','user_id','comment','flag'
    ];
}
