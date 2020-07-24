<?php

namespace App\Http\Controllers;

use App\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class CQUploadController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param Request $request
     * @return array
     */
    public function upload(Request $request)
    {
        $data = $request->all();
        switch ($data['post_type']) {
            case 'message':
            {
                return $this->messageHandle($data);
            }
            case 'notice':
            {
                return $this->noticeHandle($data);
            }
            case 'request':
            {
                return $this->requestHandle($data);
            }
        }
    }

    public function messageHandle($data)
    {
        $res = Dictionary::where('ask', trim($data['message']))->get();
        $len = count($res);
        if ($res != null && $len >= 1) {

            return ['reply' => str_replace('\r\n', "\r\n", str_replace('[换行]', "\r\n", $res[rand(0, $len - 1)]->ans))];
        }

        $cq = "[CQ:at,qq=".env('botQQ')."]";
        if (strpos(trim($data['message']), $cq) !== FALSE) {
            $appkey = env('appkey');
            $params = array(
                'app_id' => env('appid'),
                'session' => trim($data['user_id']),
                'question' => str_replace($cq, '', trim($data['message'])),
                'time_stamp' => strval(time()),
                'nonce_str' => strval(rand()),
                'sign' => '',
            );
            $params['sign'] = getReqSign($params, $appkey);

            $url = 'https://api.ai.qq.com/fcgi-bin/nlp/nlp_textchat';
            $response = Http::asForm()->post($url, $params);

            return ['reply' => $response['data']['answer']];
        }

    }

    public function noticeHandle($data)
    {
        return ['reply' => "hello"];
    }

    public function requestHandle($data)
    {
        switch ($data['request_type']) {
            case 'group':
            {
                if ($data['sub_type'] == 'invite' && $data['user_id'] == env('masterQQ'))
                    return ['approve' => true];
            }
        }
    }

}
