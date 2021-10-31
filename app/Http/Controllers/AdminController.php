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
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Cookie;
use function Sodium\add;

class AdminController extends Controller
{
    public function welcome(Request $request)
    {
        return "Welcome To BKFMonit API";
    }
    public function admin_users(Request $request)
    {
        $user = $this->getUser($request);

        if ($request->has('search')) {
            $user['search'] = $request->input('search');
            $user['users'] = DB::table('users')->select('id', 'name', 'username', 'created_at', 'account_expire_time')
                ->where('user_type', 2)->where('name', 'LIKE', '%' . $request->input('search') . '%')->get();

        } else {
            $user['users'] = DB::table('users')->select('id', 'name', 'username', 'created_at', 'account_expire_time')->where('user_type', 2)->get();
            $user['search'] = '';

        }


//        return $this->jsonResponse($user , 200);
        return view("admin_users", [
            'user' => $user
        ]);
    }

    public function admin_user(Request $request)
    {
        $user_id = $request->input('user_id');

        $user = User::all()->where('id', $user_id)->first();

        if ($request->has('search')) {
            $user['search'] = $request->input('search');
            $user['systems'] = DB::table('systems')->select('id', 'system_type', 'serial', 'name', 'created_at')
                ->where('user_id', $user_id)->where('name', 'LIKE', '%' . $request->input('search') . '%')->get();

        } else {
            $user['systems'] = DB::table('systems')->select('id', 'system_type', 'serial', 'name', 'created_at')
                ->where('user_id', $user_id)->get();
            $user['search'] = '';

        }


//        return $this->jsonResponse($user , 200);
        return view("admin_user", [
            'user' => $user
        ]);
    }

    public function admin_add_user(Request $request)
    {
//        $user_id = $request->input('user_id');

//        $user = User::all()->where('id', $user_id)->first();

//        if ($request->has('search')) {
//            $user['search'] = $request->input('search');
//            $user['systems'] = DB::table('systems')->select('id', 'system_type', 'serial', 'name', 'created_at')
//                ->where('user_id', $user_id)->where('name', 'LIKE', '%' . $request->input('search') . '%')->get();
//
//        } else {
//            $user['systems'] = DB::table('systems')->select('id', 'system_type', 'serial', 'name', 'created_at')
//                ->where('user_id', $user_id)->get();
//            $user['search'] = '';
//
//        }


//        return $this->jsonResponse($user , 200);
        return view("admin_add_user");
    }
    public function admin_api_add_user(Request $request)
    {



        return redirect()->back()->with('status', 'حساب کاربری با موفقیت اضافه شد');
        return redirect()->back()->with('status', 'حساب کاربری با موفقیت اضافه شد');

//        return view("admin_add_user");
    }



    function getUser(Request $request)
    {
        $token = $request->cookie('token');
        $user = User::all()->where('api_key', $token)->first();
        return $user;
    }


    public function jsonResponse($data, $code = 200)
    {
        return response()->json($data, $code,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'], JSON_UNESCAPED_UNICODE);
    }

}
