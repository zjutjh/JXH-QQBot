<?php

namespace App;

use App\Helpers\MiraiHelper;
use Illuminate\Database\Eloquent\Model;

class MessageLog extends Model
{
    protected $fillable = [
        'qq', 'group_id', 'message', 'sender'
    ];


    public function setMessageChainAttribute($value)
    {
        $text=MiraiHelper::getPainText($value);
        $this->attributes['message'] = $text;
    }

    public function setSenderAttribute($value)
    {
        if (isset($value['id']))
            $this->attributes['qq'] = $value['id'];
        if (isset($value['group']))
            if (isset($value['group']['id']))
                $this->attributes['group_id'] = $value['group']['id'];
    }


}
