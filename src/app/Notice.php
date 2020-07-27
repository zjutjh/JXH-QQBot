<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'notice_type', 'sub_type','group_id','operator_id','user_id'
    ];
}
