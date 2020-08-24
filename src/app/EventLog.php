<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventLog extends Model
{
    protected $fillable = [
        'type', 'qq','group_id','event_id','message','from_id'
    ];


    public function setQqAttribute($value)
    {
        if (isset($value['fromId']))
            $this->attributes['qq'] = $value['fromId'];
        if (isset($value['qq']))
            $this->attributes['qq'] = $value['qq'];
    }

    public function setFromIdAttribute($value)
    {
        if (isset($value['fromId']))
            $this->attributes['qq'] = $value['fromId'];

        if (isset($value['groupId']))
            $this->attributes['group_id'] = $value['groupId'];

        if (isset($value['eventId']))
            $this->attributes['event_id'] = $value['eventId'];

    }

}
