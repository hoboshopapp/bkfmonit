<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Cookie;

class PanelController extends Controller
{
    public function welcome(Request $request)
    {
        return "Welcome To BKFMonit API";
    }

    public function dashboard(Request $request)
    {
        $user = $this->getUser($request);
        $system_id =0;
        if ($request->has('system_id')){
            $system_id = \request()->input('system_id');
        }
        if ($system_id == 0) {
            $user['selected_system'] = $user->systems->first();
        } else {
            $user['selected_system'] = $user->systems->find($system_id);
        }

        $data['user'] = $user;

        foreach ($user->systems as $system) {
            $system['last_record'] = $system->temp_records->get(rand(1, 9));
        }


//        return $this->jsonResponse($data , 200);
        return view("welcome", [
            'user' => $user
        ]);
    }

    public function dashboard_data(Request $request, $system_id = 0)
    {
        $user = $this->getUser($request);
        $user['selected_system'] = $user->systems->find($system_id);
        $data['user'] = $user;

        foreach ($user->systems as $system) {
            $system['last_record'] = $system->temp_records->get(rand(1, 9));
        }


        return $this->jsonResponse($data, 200);
//        return view("welcome" , [
//            'user' => $user
//        ]);
    }

    public function login(Request $request)
    {
        if ($request->hasCookie('token')) {
            $token = $request->cookie('token');
            if (DB::table('users')->where('api_key', $token)) {
                return \redirect()->route('dashboard');
            } else {
                return view('login');
            }
        } else {
            return view('login');
        }
    }


    public function check_login(Request $request)
    {

        $username = $request->get('username');
        $password = $request->get('password');

        if (DB::table('users')->where('username', $username)->where('password', $password)->exists()) {
            $token = DB::table('users')->where('username', $username)->where('password', $password)->first()->api_key;
            return redirect('/')->withCookie(Cookie::create('token', $token));
        } else {
//            return view('login' , [
//                'status' => 'نام کاربری یا رمز عبور وارد شده صحیح نمی باشد !'
//            ]);
//            $request->session()->flash('status', 'Invalid Username or Password');
//            return view('login');

            return redirect()->back()->with('status', 'username or password is incorrect !');
//           return back()->withInput()->withErrors(['status'=> 'نام کاربری یا رمز عبور وارد شده صحیح نمی باشد !']);
//           return redirect()->route('login')->with('status' , 'smksnskn');
//            return "$username username or password $password incorrect";
//        }
        }
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
