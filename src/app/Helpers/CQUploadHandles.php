<?php


namespace App\Helpers;


use App\BlackList;
use App\Chat;
use App\Dictionary;
use App\Notice;
use App\RequestLog;

class CQUploadHandles
{
    public static function messageHandle($data)
    {
        $chat = new Chat();
        $chat->fill($data);
        $chat->save();
        $msg = trim($data['message']);

        if ($msg === CQCode::atBot())
            $msg = '菜单';

        $res = Dictionary::where('ask', trim($data['message']))->get();
        if (count($res) === 0)
            $res = null;
        if ($res != null)
            $res = str_replace('\r\n', "\r\n", str_replace('[换行]', "\r\n", $res[rand(0, count($res) - 1)]->ans));

        else if (strpos($msg, CQCode::atBot()) !== FALSE)
            $res = AIChat::TencentAIChat(trim($data['user_id']), trim(str_replace(CQCode::atBot(), '', trim($data['message']))));

        if ($res !== [] && $res !== '' && $res !== null) {
            $chat['reply'] = $res;
            $chat->save();
            return ['reply' => $res];
        }

    }

    public static function noticeHandle($data)
    {
        Notice::Create($data);
    }

    public static function requestHandle($data)
    {
        RequestLog::Create($data);
        switch ($data['request_type']) {
            case 'group':
            {
                if ($data['sub_type'] == 'invite' && $data['user_id'] == env('masterQQ'))
                    return ['approve' => true];
                elseif ($data['sub_type'] == 'add'){
                    $BenUser=BlackList::where('user_id',$data['user_id'])->first();
                    if($BenUser!==null){
                        $BenUser['reject_times']=$BenUser['reject_times']+1;
                        $BenUser->save();
                        return ['approve' => false];
                    }

                }
            }
        }
    }
}
