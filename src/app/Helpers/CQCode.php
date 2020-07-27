<?php


namespace App\Helpers;


class CQCode
{
    public static function atBot(){
        return "[CQ:at,qq=".env('botQQ')."]";
    }
}
