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

class PanelController extends Controller
{
    public function welcome(Request $request)
    {
        return "Welcome To BKFMonit API";
    }

    public function dashboard(Request $request)
    {


        $user = $this->getUser($request);
        $system_id = 0;
        if ($request->has('system_id')) {
            $system_id = \request()->input('system_id');
        }
        if ($system_id == 0) {
            $user['selected_system'] = $user->systems->first();
        } else {
            $user['selected_system'] = $user->systems->find($system_id);
        }

        $data['user'] = $user;

        $charts = $this->getChartRecords($user['selected_system']);
        $user->selected_system['today_charts'] = $charts;

        foreach ($user->systems as $system) {
            $system['last_record'] = $system->temp_records->get(rand(1, 9));
        }


//        return $charts;
//        return $this->jsonResponse($data , 200);
        return view("welcome", [
            'user' => $user
        ]);
    }


    public function getChartRecords($selected_system)
    {
        $charts = [];
        $temp1_chart = [];
        $chart_clocks = [];
        $temp2_chart = [];
        $hum_chart = [];
        $co2_chart = [];
        $error_chart = [];
        $today = today()->toDateString();
//        echo $today;
//        $temp1_chart[0] = 12;
//        dd($temp1_chart);
        $count = DB::table('systems_records')
            ->where('system_id', '=', $selected_system->id)
            ->whereBetween('date', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->count();

        $error_count = DB::table('systems_records')
            ->where('system_id', '=', $selected_system->id)
            ->where('error', '=', 1)
            ->whereBetween('date', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->count('error');

        $ok_count = DB::table('systems_records')
            ->where('system_id', '=', $selected_system->id)
            ->where('error', '=', 0)
            ->whereBetween('date', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->count();

//        $error_chart[0] = $count;
        $error_chart[0] = $ok_count;
        $error_chart[1] = $error_count;

        for ($i = 0; $i < 24; $i++) {
            $from_hour = '00:00:00';
            $to_hour = '00:00:00';

            if ($i <= 9) {
                $from_hour = '0' . $i . ':00:00';
                $to_hour = '0' . $i . ':59:59';
            }
            if (9 < $i) {
                $from_hour = $i . ':00:00';
                $to_hour = $i . ':59:59';
            }

            $chart_clocks[$i] = substr($from_hour, 0, 5);
//            print $from_hour .'  '. $to_hour .'/      /';


//            $temp = SystemRecord::all()->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
//                ->take(1)
//                ->avg('temp1');
            $temp = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('temp1');

            $temp1_chart[$i] = $temp;

            $temp2 = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('temp2');

            $temp2_chart[$i] = $temp2;

            $hum = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('hum');

            $hum_chart[$i] = $hum;

            $co2 = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('co2');

            $co2_chart[$i] = $co2;


//            $hum = SystemRecord::all()->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
//                ->take(10)
//                ->avg('hum');
//            $hum_chart[$i] = $hum;
//
//            $temp2 = SystemRecord::all()->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
//                ->take(10)
//                ->avg('temp2');
//            $temp2_chart[$i] = $temp2;

        }


        $charts['temp1_chart'] = $temp1_chart;
        $charts['temp2_chart'] = $temp2_chart;
        $charts['clock_chart'] = $chart_clocks;
        $charts['hum_chart'] = $hum_chart;
        $charts['co2_chart'] = $co2_chart;
        $charts['error_chart'] = $error_chart;
//        dd($charts);

        return $charts;
    }

    public function getTodayChartRecords($selected_system, $day)
    {
        $charts = [];
        $temp1_chart = [];
        $chart_clocks = [];
        $temp2_chart = [];
        $hum_chart = [];
        $co2_chart = [];
        $error_chart = [];
        $today = $day->toDateString();
//        echo $today;
//        $temp1_chart[0] = 12;
//        dd($temp1_chart);
//        $count = DB::table('systems_records')
//            ->where('system_id', '=', $selected_system->id)
//            ->whereBetween('date', [$today . ' 00:00:00', $today . ' 23:59:59'])
//            ->count();

        $error_count = DB::table('systems_records')
            ->where('system_id', '=', $selected_system->id)
            ->where('error', '=', 1)
            ->whereBetween('date', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->count('error');

        $ok_count = DB::table('systems_records')
            ->where('system_id', '=', $selected_system->id)
            ->where('error', '=', 0)
            ->whereBetween('date', [$today . ' 00:00:00', $today . ' 23:59:59'])
            ->count();

//        $error_chart[0] = $count;
        $error_chart[0] = $ok_count;
        $error_chart[1] = $error_count;

        for ($i = 0; $i < 24; $i++) {
            $from_hour = '00:00:00';
            $to_hour = '00:00:00';

            if ($i <= 9) {
                $from_hour = '0' . $i . ':00:00';
                $to_hour = '0' . $i . ':59:59';
            }
            if (9 < $i) {
                $from_hour = $i . ':00:00';
                $to_hour = $i . ':59:59';
            }

            $chart_clocks[$i] = substr($from_hour, 0, 5);
//            print $from_hour .'  '. $to_hour .'/      /';


//            $temp = SystemRecord::all()->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
//                ->take(1)
//                ->avg('temp1');
            $temp = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('temp1');

            $temp1_chart[$i] = $temp;

            $temp2 = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('temp2');

            $temp2_chart[$i] = $temp2;

            $hum = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('hum');

            $hum_chart[$i] = $hum;

            $co2 = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('co2');

            $co2_chart[$i] = $co2;


//            $hum = SystemRecord::all()->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
//                ->take(10)
//                ->avg('hum');
//            $hum_chart[$i] = $hum;
//
//            $temp2 = SystemRecord::all()->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
//                ->take(10)
//                ->avg('temp2');
//            $temp2_chart[$i] = $temp2;

        }


        $charts['temp1_chart'] = $temp1_chart;
        $charts['temp2_chart'] = $temp2_chart;
        $charts['clock_chart'] = $chart_clocks;
        $charts['hum_chart'] = $hum_chart;
        $charts['co2_chart'] = $co2_chart;
        $charts['error_chart'] = $error_chart;
//        dd($charts);

        return $charts;
    }

    public function getWeekChartRecords($selected_system , $day)
    {
        $system_id = $selected_system->id;

        $charts = [];
        $temp1_chart = [];
        $chart_clocks = [];
        $temp2_chart = [];
        $hum_chart = [];
        $co2_chart = [];
        $error_chart = [];

//        $today = $day->toDateString();


        // if from day is set
        $from_day = 'from_day';
        $to_day = 'from day +7';
        //else
        $from_day = today()->addDays(-7);
        $to_day = today()->toDateString();
//        return $from_day . ' ' . $to_day;

        $today = today()->toDateString();


        $result = [];
        for ($i = 0; $i < 7; $i++) {
            $now_day = $from_day->addDays(1)->toDateString();
            for ($j = 0; $j < 4; $j++) {
                switch ($j) {
                    case 0:
                        array_push($result, $now_day . ' 00:00:00');
                        break;
                    case 1:
                        array_push($result, $now_day . ' 06:00:00');
                        break;
                    case 2:
                        array_push($result, $now_day . ' 12:00:00');
                        break;
                    case 3:
                        array_push($result, $now_day . ' 18:00:00');
                        break;
                }
            }


        }
        $chart_clocks = $result;

        foreach ($chart_clocks as $chart_clock) {
            $from_d = $chart_clock;
            $to_d = date('Y-m-d H:i:s', strtotime($chart_clock . " + 5 hours + 59 minutes"));


            array_push($temp1_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('temp1'));

            array_push($temp2_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('temp2'));

            array_push($hum_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('hum'));

            array_push($co2_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('co2'));

        }



        $error_count = DB::table('systems_records')
            ->where('system_id', '=', $system_id)
            ->where('error', '=', 1)
            ->whereBetween('date', [$chart_clocks[0],$chart_clocks[27]])
            ->count('error');

        $ok_count = DB::table('systems_records')
            ->where('system_id', '=', $system_id)
            ->where('error', '=', 0)
            ->whereBetween('date', [$chart_clocks[0],$chart_clocks[27]])
            ->count();

        $error_chart[0] = $ok_count;
        $error_chart[1] = $error_count;
//
//
//        }
//
//
        $charts['temp1_chart'] = $temp1_chart;
        $charts['temp2_chart'] = $temp2_chart;
        $charts['clock_chart'] = $chart_clocks;
        $charts['hum_chart'] = $hum_chart;
        $charts['co2_chart'] = $co2_chart;
        $charts['error_chart'] = $error_chart;
//        dd($charts);

        return $charts;
    }

    public function getMonthChartRecords($selected_system , $day)
    {
        $system_id = $selected_system->id;

        $charts = [];
        $temp1_chart = [];
        $chart_clocks = [];
        $temp2_chart = [];
        $hum_chart = [];
        $co2_chart = [];
        $error_chart = [];

//        $today = $day->toDateString();


        // if from day is set
        $from_day = 'from_day';
        $to_day = 'from day +7';
        //else
        $from_day = today()->addDays(-26);
        $to_day = today()->toDateString();
//        return $from_day . ' ' . $to_day;

        $today = today()->toDateString();


        $result = [];
        for ($i = 0; $i < 28; $i++) {
            $now_day = $from_day->addDays(1)->toDateString();
            array_push($result, $now_day . ' 00:00:00');
        }

        $chart_clocks = $result;

        foreach ($chart_clocks as $chart_clock) {
            $from_d = $chart_clock;
            $to_d = date('Y-m-d H:i:s', strtotime($chart_clock . " + 24 hours + 59 minutes"));


            array_push($temp1_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('temp1'));

            array_push($temp2_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('temp2'));

            array_push($hum_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('hum'));

            array_push($co2_chart, DB::table('systems_records')->where('system_id', '=', $system_id)
                ->whereBetween('date', [$from_d, $to_d])->avg('co2'));

        }



        $all_error = DB::table('systems_records')
            ->where('system_id', '=', $selected_system->id)
            ->whereBetween('date' ,  [$chart_clocks[0],$chart_clocks[27]])
            ->get();

        $ok_count = 0;
        $error_count = 0;

        foreach ($all_error as $error) {
            $error->error == 0 ? $ok_count++ : $error_count++;
        }


        $error_chart[0] = $ok_count;
        $error_chart[1] = $error_count;

//
//
//        }
//
//
        $charts['temp1_chart'] = $temp1_chart;
        $charts['temp2_chart'] = $temp2_chart;
        $charts['clock_chart'] = $chart_clocks;
        $charts['hum_chart'] = $hum_chart;
        $charts['co2_chart'] = $co2_chart;
        $charts['error_chart'] = $error_chart;
//        dd($charts);

        return $charts;
    }

    public function getLastChartRecords($selected_system)
    {
        $charts = [];
        $temp1_chart = [];
        $chart_clocks = [];
        $temp2_chart = [];
        $hum_chart = [];
        $co2_chart = [];
        $error_chart = [];
//        $today = $day->toDateString();
//        echo $today;
//        $temp1_chart[0] = 12;
//        dd($temp1_chart);
//        $count = DB::table('systems_records')
//            ->where('system_id', '=', $selected_system->id)
//            ->whereBetween('date', [$today . ' 00:00:00', $today . ' 23:59:59'])
//            ->count();

        $all_error = DB::table('systems_records')
            ->where('system_id', '=', $selected_system->id)
            ->limit(50)
            ->orderBy('id', 'desc')
            ->get();

        $ok_count = 0;
        $error_count = 0;

        foreach ($all_error as $error) {
            $error->error == 0 ? $ok_count++ : $error_count++;
        }


        $error_chart[0] = $ok_count;
        $error_chart[1] = $error_count;


        $chart_rows = DB::table('systems_records')
            ->select('temp2', 'hum', 'co2', 'temp1', 'date')
            ->where('system_id', '=', $selected_system->id)
            ->orderBy('id', 'desc')
            ->limit(50)
            ->get();

        foreach ($chart_rows as $i => $chart_row) {
            $chart_clocks[$i] = substr($chart_row->date, 11, 19);
            $temp1_chart[$i] = $chart_row->temp1;
            $temp2_chart[$i] = $chart_row->temp2;
            $hum_chart[$i] = $chart_row->hum;
            $co2_chart[$i] = $chart_row->co2;
        }


//
//
//
//
//
//
//            $temp1_chart[$i] = $temp;
//        for ($i = 0; $i < 24; $i++) {
//            $from_hour = '00:00:00';
//            $to_hour = '00:00:00';
//
//            if ($i <= 9) {
//                $from_hour = '0' . $i . ':00:00';
//                $to_hour = '0' . $i . ':59:59';
//            }
//            if (9 < $i) {
//                $from_hour = $i . ':00:00';
//                $to_hour = $i . ':59:59';
//            }
//
//            $chart_clocks[$i] = substr($from_hour, 0, 5);
////            print $from_hour .'  '. $to_hour .'/      /';
//
//
////            $temp = SystemRecord::all()->where('system_id', '=', $selected_system->id)
////                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
////                ->take(1)
////                ->avg('temp1');
//            $temp = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('temp1');
//
//            $temp1_chart[$i] = $temp;
//
//            $temp2 = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('temp2');
//
//            $temp2_chart[$i] = $temp2;
//
//            $hum = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('hum');
//
//            $hum_chart[$i] = $hum;
//
//            $co2 = DB::table('systems_records')->where('system_id', '=', $selected_system->id)
//                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])->avg('co2');
//
//            $co2_chart[$i] = $co2;
//
//
////            $hum = SystemRecord::all()->where('system_id', '=', $selected_system->id)
////                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
////                ->take(10)
////                ->avg('hum');
////            $hum_chart[$i] = $hum;
////
////            $temp2 = SystemRecord::all()->where('system_id', '=', $selected_system->id)
////                ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
////                ->take(10)
////                ->avg('temp2');
////            $temp2_chart[$i] = $temp2;
//
//        }


        $charts['temp1_chart'] = $temp1_chart;
        $charts['temp2_chart'] = $temp2_chart;
        $charts['clock_chart'] = $chart_clocks;
        $charts['hum_chart'] = $hum_chart;
        $charts['co2_chart'] = $co2_chart;
        $charts['error_chart'] = $error_chart;
//        dd($charts);

        return $charts;
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

    public function charts(Request $request)
    {
        $user = $this->getUser($request);

        $system_id = 0;

        if ($request->has('system_id')) {
            $system_id = \request()->input('system_id');
        }

        if ($system_id == 0) {
            $user['selected_system'] = $user->systems->first();
        } else {
            $user['selected_system'] = $user->systems->find($system_id);
        }

        $charts = $this->getTodayChartRecords($user['selected_system'], today());
        $last_charts = $this->getLastChartRecords($user['selected_system']);
        $week_charts = $this->getWeekChartRecords($user['selected_system'], today());
        $month_charts = $this->getMonthChartRecords($user['selected_system'], today());
//        $month_charts = $this->getLastChartRecords($user['selected_system']);
        $user->selected_system['today_charts'] = $charts;
        $user->selected_system['last_charts'] = $last_charts;
        $user->selected_system['week_charts'] = $week_charts;
        $user->selected_system['month_charts'] = $month_charts;


//        $system_id = $request->input('system_id');
//        $charts_type = $request->input('charts_type');
//        $start_date  =$request->input('start_date');
//        $end_date  =$request->input('end_date');


//        return $this->jsonResponse($user, 200);
        return view("charts", [
            'user' => $user
        ]);
    }

    public function charts_data(Request $request)
    {
        $user = $this->getUser($request);

        $system_id = 0;

        if ($request->has('system_id')) {
            $system_id = \request()->input('system_id');
        }

        if ($system_id == 0) {
            $user['selected_system'] = $user->systems->first();
        } else {
            $user['selected_system'] = $user->systems->find($system_id);
        }


        $charts = $this->getTodayChartRecords($user['selected_system'], today());
        $last_charts = $this->getLastChartRecords($user['selected_system']);
        $user->selected_system['today_charts'] = $charts;
        $user->selected_system['last_charts'] = $last_charts;

//        $system_id = $request->input('system_id');
//        $charts_type = $request->input('charts_type');
//        $start_date  =$request->input('start_date');
//        $end_date  =$request->input('end_date');


        return $this->jsonResponse($user, 200);
//        return view("charts", [
//            'user' => $user
//        ]);
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
