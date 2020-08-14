<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Dictionary;
use App\Helpers\AIChat;
use App\Helpers\CQUploadHandles;
use App\Helpers\MiraiUploadHandles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\ErrorHandler\Debug;

class MiraiUploadController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param Request $request
     * @return array
     */
    public function upload(Request $request)
    {

        $req = $request->all();
        if ($req) {

            MiraiUploadHandles::MiraiHandle($req);
        }
        return 'OK';

    }

    /**
     * @param Request $request
     * @param $methods
     * @return mixed
     */
    public function api(Request $request, $methods)
    {
        $data = $request->all();
        return Http::post((env('Mirai_POST') . $methods), $data);
    }


}
