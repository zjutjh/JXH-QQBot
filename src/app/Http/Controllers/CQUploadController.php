<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Dictionary;
use App\Helpers\AIChat;
use App\Helpers\CQUploadHandles;
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
                return CQUploadHandles::messageHandle($data);
            }
            case 'notice':
            {
                return CQUploadHandles::noticeHandle($data);
            }
            case 'request':
            {
                return CQUploadHandles::requestHandle($data);
            }
        }
    }

    /**
     * @param Request $request
     * @param $methods
     * @return mixed
     */
    public function api(Request $request, $methods) {
        $data = $request->all();
        return Http::post((env('CQ_POST').$methods),$data);
    }



}
