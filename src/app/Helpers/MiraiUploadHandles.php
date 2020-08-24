<?php


namespace App\Helpers;


use App\BlackList;
use App\Chat;
use App\Dictionary;
use App\EventLog;
use App\MessageLog;
use App\Notice;
use App\RequestLog;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MiraiUploadHandles
{

    public static function MiraiHandle($data)
    {
        switch ($data['type']) {
            case 'GroupMessage':
            case 'FriendMessage':
            case 'TempMessage':
                self::MessageHandle($data);
                break;
            case 'MemberJoinEvent':
                self::MemberJoinEventHandle($data);
                break;
            case 'MemberJoinRequestEvent' :
                self::MemberJoinRequestEventHandle($data);
                break;

        }
    }

    public static function MessageHandle($data)
    {
        MessageLog::Create($data);
        $msg = MiraiHelper::getPainText($data['messageChain']);
        if ($msg == '' && MiraiHelper::isAtBot($data['messageChain']))
            $msg = '菜单';

        $res = Dictionary::getReply($msg);

        if ($res !== null)
            $res = replaceLineMark($res[rand(0, count($res) - 1)]->ans);

        else if ($data['type'] != 'GroupMessage' || MiraiHelper::isAtBot($data['messageChain']))
            $res = AIChat::TencentAIChat(trim($data['sender']['id']), $msg);
        if ($res) {
            $url = '';
            $target = '';
            $messageChain = [];
            switch ($data['type']) {
                case 'GroupMessage':
                    $url = MiraiSender::sendGroupMessage;
                    $target = trim($data['sender']['group']['id']);
                    $messageChain = [
                        MiraiHelper::BuildMessagePlain($res)
                    ];
                    break;
                case 'FriendMessage':
                    $url = MiraiSender::sendFriendMessage;
                    $target = trim($data['sender']['id']);
                    $messageChain = [
                        MiraiHelper::BuildMessagePlain($res)
                    ];
                    break;
                case 'TempMessage':
                    $url = MiraiSender::sendTempMessage;
                    $target = trim($data['sender']['id']);
                    $messageChain = [
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

        $res = Dictionary::getReply('%欢迎');
        if ($res !== null)
            $res = replaceLineMark($res[rand(0, count($res) - 1)]->ans);

        $url = MiraiSender::sendGroupMessage;
        $target = trim($data['member']['group']['id']);
        $messageChain = [
            MiraiHelper::BuildMessageAt($data['member']['id']),
            MiraiHelper::BuildMessagePlain($res)
        ];

        $data = array(
            'messageChain' => $messageChain,
            'target' => $target);

        MiraiSender::Send($url, $data);

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

        DB::transaction(function ()use ($data) {
            $BenUser = BlackList::where('user_id', $data['fromId'])->lockForUpdate()->first();
            if ($BenUser !== null) {
                $data = array(
                    'eventId' => $data['eventId'],
                    'fromId' => $data['fromId'],
                    'groupId' => $data['groupId'],
                    'operate' => 1,
                    'message' => "您的账号存在问题，请联系管理员解决问题"
                );
                MiraiSender::Send(MiraiSender::memberJoinRequestEvent, $data);
                $BenUser['reject_times'] = $BenUser['reject_times'] + 1;
                $BenUser->save();
            }
        });
        EventLog::Create($data);

    }

    public static function BotInvitedJoinGroupRequestEventHandle($data)
    {

    }
}
