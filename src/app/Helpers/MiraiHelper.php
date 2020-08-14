<?php


namespace App\Helpers;


use App\BlackList;
use App\Chat;
use App\Dictionary;
use App\Notice;
use App\RequestLog;

class MiraiHelper
{


    public static function BuildMessageData($target, $messageChain)
    {
        return array(
            "target" => $target,
            "messageChain" => $messageChain,

        );
    }

    public static function BuildTempMessageData($qq, $group, $messageChain)
    {
        return array(
            "qq" => $qq,
            "group" => $group,
            "messageChain" => $messageChain,
        );
    }

    public static function BuildMessageAt($id)
    {
        return array(
            "type" => "At",
            "target" => $id,
        );
    }

    public static function BuildMessagePlain($plain)
    {
        return array(
            "type" => "Plain",
            "text" => $plain,
        );
    }

    public static function BuildMessageImage($path)
    {
        return array(
            "type" => "Image",
            "path" => $path,
        );
    }

    public static function BuildMessagePoke($name)
    {
        return array(
            "type" => "Poke",
            "name" => $name,
        );
    }


    public static function isAtBot($messageChain)
    {
        foreach ($messageChain as $message) {
            if ($message['type'] === 'At' && $message['target'] === env('botQQ'))
                return true;
        }
        return false;
    }

    public static function getPainText($messageChain)
    {
        $res='';
        foreach ($messageChain as $message) {
            if ($message['type'] === 'Plain')
                $res.=$message['text'];
        }
        return $res;
    }
}
