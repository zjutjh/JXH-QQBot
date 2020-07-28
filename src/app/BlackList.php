<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    protected $fillable = [ 'user_id', 'comments' ];
}
