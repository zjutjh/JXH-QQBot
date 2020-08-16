<?php


namespace App\Helpers;


use App\BlackList;
use App\Chat;
use App\Dictionary;
use App\Notice;
use App\RequestLog;
use Illuminate\Support\Facades\Log;

class MiraiUploadHandles
{

    public static function MiraiHandle($data)
    {
        switch ($data['type']) {
            case 'GroupMessage':
            case 'FriendMessage':
            case 'TempMessage':
                self::MessageHandle($data);
        }
    }

    public static function MessageHandle($data)
    {
        $msg = MiraiHelper::getPainText($data['messageChain']);
        Log::info($data);
        if ($msg == '' && MiraiHelper::isAtBot($data['messageChain']) )
            $msg = '菜单';

        $res = Dictionary::getReply($msg);

        Log::info(MiraiHelper::isAtBot($data['messageChain']));
        if ($res !== null)
            $res = replaceLineMark($res[rand(0, count($res) - 1)]->ans);

        else if ($data['type'] != 'GroupMessage' || MiraiHelper::isAtBot($data['messageChain']))
            $res = AIChat::TencentAIChat(trim($data['sender']['id']), $msg);
        if ($res) {
            $res="\r\n".$res;
            $url = '';
            $target='';
            $messageChain=[];
            switch ($data['type']) {
                case 'GroupMessage':
                    $url = MiraiSender::sendGroupMessage;
                    $target=trim($data['sender']['group']['id']);
                    $messageChain= [
                        MiraiHelper::BuildMessageAt($data['sender']['id']),
                        MiraiHelper::BuildMessagePlain($res)
                    ];
                    break;
                case 'FriendMessage':
                    $url = MiraiSender::sendFriendMessage;
                    $target=trim($data['sender']['id']);
                    $messageChain= [
                        MiraiHelper::BuildMessagePlain($res)
                    ];
                    break;
                case 'TempMessage':
                    $url = MiraiSender::sendTempMessage;
                    $target=trim($data['sender']['id']);
                    $messageChain= [
                        MiraiHelper::BuildMessagePlain($res)
                    ];
                    break;
            }
            $data = array(
                'messageChain' => $messageChain,
                'target' => $target);

            MiraiSender::Send($url, $data);
        }
    }

    public static function MemberJoinEventHandle($data)
    {

    }

    public static function MemberLeaveEventKickHandle($data)
    {

    }

    public static function MemberLeaveEventQuitHandle($data)
    {

    }

    public static function MemberCardChangeEventHandle($data)
    {

    }

    public static function MemberSpecialTitleChangeEventHandle($data)
    {

    }

    public static function MemberPermissionChangeEventHandle($data)
    {

    }

    public static function MemberMuteEventHandle($data)
    {

    }

    public static function MemberUnmuteEventHandle($data)
    {

    }

    public static function NewFriendRequestEventHandle($data)
    {

    }

    public static function MemberJoinRequestEventHandle($data)
    {

    }

    public static function BotInvitedJoinGroupRequestEventHandle($data)
    {

    }
}
