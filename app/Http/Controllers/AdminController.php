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
use Psy\Util\Str;
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
        return view("admin_add_user");
    }

    public function admin_edit_user(Request $request)
    {
        $user_id = $request->input('user_id');

        $user = User::all()->where('id', $user_id)->first();

        return view("admin_edit_user", [
            'user' => $user
        ]);
    }

    public function admin_api_add_user(Request $request)
    {
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $expire_date = $request->input('date_picker');
        if (DB::table('users')->where('username', $username)->exists()) {
            return redirect()->back()->with('status', 'error')->with('message', 'نام کابری قبلا استفاده شده است .');
        } else {
            $day = new Carbon(date('Y-m-d H:i:s', strtotime(request()->input('date_picker'))));

            $user_id = DB::table('users')->insertGetId([
                'name' => $name,
                'user_type' => 2,
                'username' => $username,
                'password' => $password,
                'api_key' => \Illuminate\Support\Str::random(50),
                'created_at' => now(),
                'updated_at' => now(),
                'account_expire_time' => $day,
            ]);
            $system_id = DB::table('systems')->insertGetId([
                'system_type' => 1,
                'serial' => 'xxx',
                'name' => 's',
                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            DB::table('systems_records')->insert([
                'system_type' => 1,
                'system_id' => $system_id,
                'system_read' => rand(0, 1),
                'temp1' => rand(70.00, 99.99),
                'temp2' => rand(70.00, 99.99),
                'hum' => rand(70.00, 99.99),
                'set_temp1' => rand(70.00, 99.99),
                'set_temp2' => rand(70.00, 99.99),
                'set_hum' => rand(70.00, 99.99),
                'fan_control' => rand(0, 1),
                's_error' => 'error',
                'fan' => rand(70.00, 99.99),
                'pressure' => rand(70.00, 99.99),
                'co2' => rand(70.00, 99.99),

                'egg_turn' => rand(0, 1),
                'dumper' => rand(0, 1),
                'high_temp' => rand(0, 1),
                'low_temp' => rand(0, 1),
                'high_hum' => rand(0, 1),
                'low_hum' => rand(0, 1),
                'door_open' => rand(0, 1),
                'fan_failure' => rand(0, 1),
                'dry_wick' => rand(0, 1),
                'error_program' => rand(0, 1),
                'heater' => rand(0, 1),
                'spray' => rand(0, 1),
                'damper_opening' => rand(0, 1),
                'damper_open' => rand(0, 1),
                'auxlary_heater' => rand(0, 1),
                'damper_closing' => rand(0, 1),
                'damper_closed' => rand(0, 1),
                'egg_left' => rand(0, 1),
                'egg_right' => rand(0, 1),
                'turning' => rand(0, 1),
                'egg_failure' => rand(0, 1),
                'blower' => rand(0, 1),
                'auxlary_damper' => rand(0, 1),
                'error' => rand(0, 1),

                'date' => today(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->back()->with('status', 'success')->with('message', 'حساب کاربری با موفقیت اضافه شد .');

        }

//        return view("admin_add_user");
    }

    public function admin_api_add_system(Request $request)
    {

        $user_id = $request->input('user_id');
        $serial = $request->input('serial');
        $name = $request->input('name');
        $system_type = $request->input('system_type');

        $system_id = DB::table('systems')->insertGetId([
            'name' => $name,
            'serial' => $serial,
            'user_id' => $user_id,
            'system_type' => $system_type,
            'created_at' => now(),
            'updated_at' => now()
        ]);


        DB::table('systems_records')->insert([
            'system_type' => 1,
            'system_id' => $system_id,
            'system_read' => rand(0, 1),
            'temp1' => rand(70.00, 99.99),
            'temp2' => rand(70.00, 99.99),
            'hum' => rand(70.00, 99.99),
            'set_temp1' => rand(70.00, 99.99),
            'set_temp2' => rand(70.00, 99.99),
            'set_hum' => rand(70.00, 99.99),
            'fan_control' => rand(0, 1),
            's_error' => 'error',
            'fan' => rand(70.00, 99.99),
            'pressure' => rand(70.00, 99.99),
            'co2' => rand(70.00, 99.99),

            'egg_turn' => rand(0, 1),
            'dumper' => rand(0, 1),
            'high_temp' => rand(0, 1),
            'low_temp' => rand(0, 1),
            'high_hum' => rand(0, 1),
            'low_hum' => rand(0, 1),
            'door_open' => rand(0, 1),
            'fan_failure' => rand(0, 1),
            'dry_wick' => rand(0, 1),
            'error_program' => rand(0, 1),
            'heater' => rand(0, 1),
            'spray' => rand(0, 1),
            'damper_opening' => rand(0, 1),
            'damper_open' => rand(0, 1),
            'auxlary_heater' => rand(0, 1),
            'damper_closing' => rand(0, 1),
            'damper_closed' => rand(0, 1),
            'egg_left' => rand(0, 1),
            'egg_right' => rand(0, 1),
            'turning' => rand(0, 1),
            'egg_failure' => rand(0, 1),
            'blower' => rand(0, 1),
            'auxlary_damper' => rand(0, 1),
            'error' => rand(0, 1),

            'date' => today(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('status', 'success')->with('message', 'دستگاه با موفقیت اضافه شد .');


//        return view("admin_add_user");
    }

    public function admin_add_system(Request $request)
    {
        $user_id = $request->input('user_id');


        return view("admin_add_system", ['user_id' => $user_id]);
    }

    public function admin_api_edit_user(Request $request)
    {
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $username = $request->input('username');
        $password = $request->input('password');
        $expire_date = $request->input('date_picker');

        if (DB::table('users')->where('username', $username)->where('id', '<>', $user_id)->exists()) {
            return redirect()->back()->with('status', 'error')->with('message', 'نام کابری قبلا استفاده شده است .');
        } else {
            $day = new Carbon(date('Y-m-d H:i:s', strtotime(request()->input('date_picker'))));
            DB::table('users')->where('id', $user_id)->update([
                'name' => $name,
                'username' => $username,
                'password' => $password,
                'account_expire_time' => $day,
                'updated_at' => now(),
            ]);

        }
//        return $user_id;
        return redirect()->back()->with('status', 'success')->with('message', 'حساب کاربری با موفقیت ,ویرایش شد .');


//        return view("admin_add_user");
    }

    public function admin_api_delete_user(Request $request)
    {
        $user_id = $request->input('user_id');
//        DB::table('systems')->where('user_id', $user_id)->delete();

        User::all()->find($user_id)->delete();

        return $this->jsonResponse("success", 200);


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
