<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\SystemRecord;
use App\Models\User;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Cookie;
use function Sodium\add;

class ApiController extends Controller
{
    public function post_data(Request $request)
    {
        DB::table('test_data')->insert([
            'data' => $request->input('data')
        ]);

        return  $this->jsonResponse( 'Data Has Saved Successfully',200);
    }













    public function jsonResponse($data, $code = 200)
    {
        return response()->json($data, $code,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

}
