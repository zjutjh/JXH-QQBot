<?php

namespace App\Http\Controllers;


use App\Dictionary;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class DictionaryController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get(Request $request)
    {
       return StandardSuccessJsonResponse(Dictionary::all());
    }

    public function add(Request $request)
    {
        $all = $request->all();
        Dictionary::create($all);
        return StandardSuccessJsonResponse();
    }

    public function remove(Request $request)
    {
        $all = $request->all();
        $dic = Dictionary::where('id', $all['id'])->first();
        $dic->delete();
        return StandardSuccessJsonResponse();
    }

    public function update(Request $request)
    {
        $all = $request->all();
        $dic = Dictionary::where('id', $all['id'])->first();
        $dic->fill($all);
        $dic->save();
        return StandardSuccessJsonResponse();
    }
}
