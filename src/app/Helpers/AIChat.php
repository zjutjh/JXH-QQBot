<?php


namespace App\Helpers;
use Illuminate\Support\Facades\Http;

class AIChat
{
    static function TencentAIChat($sessionId,$message)
    {
        $appkey = env('TencentAIChatAppkey');
        $params = array(
            'app_id' => env('TencentAIChatAppid'),
            'session' => trim($sessionId),
            'question' => $message,
            'time_stamp' => strval(time()),
            'nonce_str' => strval(rand()),
            'sign' => '',
        );
        $params['sign'] = getReqSign($params, $appkey);
        $url = 'https://api.ai.qq.com/fcgi-bin/nlp/nlp_textchat';
        $response = Http::asForm()->post($url, $params);
        return $response['data']['answer'];
    }
}
