<?php


namespace App\Helpers;


use App\BlackList;
use App\Chat;
use App\Dictionary;
use App\Notice;
use App\RequestLog;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MiraiSender
{
    private const verify = '/verify';
    private const auth = '/auth';

    public const sendGroupMessage = '/sendGroupMessage';
    public const sendTempMessage = '/sendTempMessage';
    public const sendFriendMessage = '/sendFriendMessage';

    public static function Send($url, $data)
    {
        Log::info('Sender');
        $host = Config::get('qqBot.report_url');
        if (!Cache::has('vertifyed') || !Cache::get('vertifyed') == true)
            MiraiSender::Auth();
        $data['sessionKey'] = Cache::get('sessionKey');
        Http::asJson()->post($host . $url, $data);
    }

    private static function Auth()
    {
        $host = Config::get('qqBot.report_url');
        $req = array(
            "authKey" => Config::get('qqBot.authkey')
        );
        $response = Http::asJson()->post($host . '/auth', $req);
        if ($response['code'] === 0)
            if (MiraiSender::Vertify($response['session']))
                Cache::put('sessionKey', $response['session']);
    }

    private static function Vertify($session)
    {
        $host = Config::get('qqBot.report_url');

        $req = array(
            "sessionKey" => $session,
            'qq' => Config::get('qqBot.botQQ')
        );
        $response = Http::asJson()->post($host . '/verify', $req);
        if ($response['code'] === 0) {
            Cache::put('vertifyed', true);
            return true;
        }
        return false;


    }
}
