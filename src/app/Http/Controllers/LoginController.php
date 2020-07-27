<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\False_;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \JsonResponse
     */
    public function __invoke(Request $request)
    {
        if ((env('AdminPass') === $request->get('pass'))){
            session(['isAdminLogin' => TRUE]);
            return StandardSuccessJsonResponse();
        }
        else
            return StandardFailJsonResponse();
    }

    public function logout(Request $request)
    {
        $isLogin =session('isAdminLogin',False);
        if ($isLogin){
            session(['isAdminLogin' => False]);
            return StandardSuccessJsonResponse();
        }
        else
            return StandardFailJsonResponse();
    }

}
