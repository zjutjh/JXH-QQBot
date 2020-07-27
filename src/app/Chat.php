<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'message_type',
        'sub_type', 'message_id', 'group_id',
        'message', 'sender', 'user_id', 'reply', 'anonymous'
    ];


    public function setSenderAttribute($value)
    {
        if (isset($value['user_id']))
            $this->attributes['sender_user_id'] = $value['user_id'];
        if (isset($value['nickname']))
            $this->attributes['sender_nickname'] = $value['nickname'];
        if (isset($value['card']))
            $this->attributes['sender_card'] = $value['card'];
        if (isset($value['role']))
            $this->attributes['sender_role'] = $value['role'];
    }

    public function setUserIdAttribute($value)
    {
        $this->attributes['sender_user_id'] = isset($value) ? $value : null;
    }

    public function setAnonymousAttribute($value)
    {
        if (isset($value['id']))
            $this->attributes['anonymous_id'] = $value['id'];
        if (isset($value['name']))
            $this->attributes['anonymous_name'] = $value['name'];
        if (isset($value['flag']))
            $this->attributes['anonymous_flag'] = $value['flag'];
    }

}
