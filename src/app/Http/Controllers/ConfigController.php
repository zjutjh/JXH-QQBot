<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ConfigController extends Controller
{
    public function get(Request $request)
    {
        return "OK";
    }

    public function set(Request $request)
    {

        return "OK";
    }
}
