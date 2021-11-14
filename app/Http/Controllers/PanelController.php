<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\SystemRecord;
use App\Models\User;
use Illuminate\Container\RewindableGenerator;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Cookie\CookieJar;
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

class PanelController extends Controller
{
    public function welcome(Request $request)
    {
        return "Welcome To BKFMonit API";
    }

    public function logout(Request $request)
    {


        $cookie = \cookie()->forget('token');

        return redirect('/login')->withCookie($cookie);

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

        if (DB::table('systems')->where('user_id', $user->id)->exists()) {

            $charts = $this->getChartRecords($user['selected_system']);
            $user->selected_system['today_charts'] = $charts;

            foreach ($user->systems as $system) {
                $system['last_record'] = $system->records->last();
            }
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
        $from_hour = '00:00:00';
        $to_hour = '23:00:00';
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
            ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
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
            ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
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

    public function getMonthChartRecords($selected_system, $day)
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


        if ($day == today()) {
            $from_day = $day->addDays(-28);
        } else {
            $from_day = $day->addDays(-7);

        }


        $result = [];
        for ($i = 0; $i < 28; $i++) {
            $now_day = $from_day->addDays(1)->toDateString();
            array_push($result, $now_day . ' 00:00:00');
        }

        $chart_clocks = $result;

        foreach ($chart_clocks as $chart_clock) {
            $from_d = $chart_clock;
            $to_d = date('Y-m-d H:i:s', strtotime($chart_clock . " + 23 hours + 59 minutes"));


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
            ->whereBetween('date', [$chart_clocks[0], $chart_clocks[27]])
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

    public function getWeekChartRecords($selected_system, $day)
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


        if ($day == today()) {
            $from_day = $day->addDays(-7);
        } else {
            $from_day = $day->addDays(-1);
        }


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
            ->whereBetween('date', [$chart_clocks[0], $chart_clocks[27]])
            ->count('error');

        $ok_count = DB::table('systems_records')
            ->where('system_id', '=', $system_id)
            ->where('error', '=', 0)
            ->whereBetween('date', [$chart_clocks[0], $chart_clocks[27]])
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


    /////////////////////////////////////


    public function getTodayTableRecords($selected_system, $day)
    {
        $tables = [];
        $today = $day->toDateString();

        $from_hour = '00:00:00';
        $to_hour = '23:59:59';


        $chart_rows = DB::table('systems_records')
            ->select('temp2', 'hum', 'co2', 'temp1', 'date', 'error')
            ->where('system_id', '=', $selected_system->id)
            ->whereBetween('date', [$today . ' ' . $from_hour, $today . ' ' . $to_hour])
            ->get();

        foreach ($chart_rows as $i => $chart_row) {

            $tables[$i] = new \stdClass();
            $tables[$i]->time = $chart_row->date;
            $tables[$i]->temp1 = $chart_row->temp1;
            $tables[$i]->temp2 = $chart_row->temp2;
            $tables[$i]->hum = $chart_row->hum;
            $tables[$i]->co2 = $chart_row->co2;
            $tables[$i]->error = $chart_row->error;
            $tables[$i]->ok = $chart_row->error;

        }


        return $tables;
    }

    public function getLastTableRecords($selected_system)
    {
        $tables = [];

        $chart_rows = DB::table('systems_records')
            ->select('temp2', 'hum', 'co2', 'temp1', 'date', 'error')
            ->where('system_id', '=', $selected_system->id)
            ->orderBy('id', 'desc')
            ->limit(50)
            ->get();

        for ($i = 0; $i < $chart_rows->count(); $i++) {
//
            $tables[$i] = new \stdClass();
            $tables[$i]->time = $chart_rows[$i]->date;
            $tables[$i]->temp1 = $chart_rows[$i]->temp1;
            $tables[$i]->temp2 = $chart_rows[$i]->temp2;
            $tables[$i]->hum = $chart_rows[$i]->hum;
            $tables[$i]->co2 = $chart_rows[$i]->co2;
            $tables[$i]->error = $chart_rows[$i]->error;
            $tables[$i]->ok = $chart_rows[$i]->error;

        }


        return $tables;
    }

    public function getWeekTableRecords($selected_system, $day)
    {
        $system_id = $selected_system->id;
        $today = $day->toDateString();

        $tables = [];
        if ($day == today()) {
            $from_day = $day->addDays(-7)->toDateString();;
            $to_day = $day->toDateString();;
        } else {
            $from_day = $day->toDateString();;
            $to_day = $day->toDateString();;
        }
        $from_hour = '00:00:00';
        $to_hour = '23:59:59';

        $result = [];
        $chart_rows = DB::table('systems_records')
            ->select('temp2', 'hum', 'co2', 'temp1', 'date', 'error')
            ->where('system_id', '=', $selected_system->id)
            ->whereBetween('date', [$from_day.' '.$from_hour , $to_day . ' ' . $to_hour])
            ->get();


//        for ($i = 0; $i < 7; $i++) {
//            $now_day = $from_day->addDays(1)->toDateString();
//            for ($j = 0; $j < 4; $j++) {
//                switch ($j) {
//                    case 0:
//                        array_push($result, $now_day . ' 00:00:00');
//                        break;
//                    case 1:
//                        array_push($result, $now_day . ' 06:00:00');
//                        break;
//                    case 2:
//                        array_push($result, $now_day . ' 12:00:00');
//                        break;
//                    case 3:
//                        array_push($result, $now_day . ' 18:00:00');
//                        break;
//                }
//            }
//        }
//        $chart_clocks = $result;

//        for ($x = 0; $x < 28; $x++) {
//            $from_d = $chart_clocks[$x];
//            $to_d = date('Y-m-d H:i:s', strtotime($chart_clocks[$x] . " + 5 hours + 59 minutes"));
//
//            $temp1 = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('temp1');
//
//            $temp2 = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('temp2');
//
//            $hum = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('hum');
//
//            $co2 = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('co2');
//
//            $error_count = DB::table('systems_records')
//                ->where('system_id', '=', $selected_system->id)
//                ->where('error', '=', 1)
//                ->whereBetween('date', [$from_d, $to_d])
//                ->count('error');
//
//            $ok_count = DB::table('systems_records')
//                ->where('system_id', '=', $selected_system->id)
//                ->where('error', '=', 0)
//                ->whereBetween('date', [$from_d, $to_d])
//                ->count();
//
//            $tables[$x] = new \stdClass();
//            $tables[$x]->time = $from_d;
//            $tables[$x]->temp1 = $temp1;
//            $tables[$x]->temp2 = $temp2;
//            $tables[$x]->hum = $hum;
//            $tables[$x]->co2 = $co2;
//            $tables[$x]->error = $error_count;
//            $tables[$x]->ok = $ok_count;
//
//        }
        foreach ($chart_rows as $i => $chart_row) {

            $tables[$i] = new \stdClass();
            $tables[$i]->time = $chart_row->date;
            $tables[$i]->temp1 = $chart_row->temp1;
            $tables[$i]->temp2 = $chart_row->temp2;
            $tables[$i]->hum = $chart_row->hum;
            $tables[$i]->co2 = $chart_row->co2;
            $tables[$i]->error = $chart_row->error;
            $tables[$i]->ok = $chart_row->error;

        }


        return $tables;
    }

    public function getMonthTableRecords($selected_system, $day)
    {
        $system_id = $selected_system->id;

        $tables = [];

//        $today = $day->toDateString();


        if ($day == today()) {
            $from_day = $day->addDays(-28)->toDateString();
            $to_day = $day->toDateString();;

        } else {
            $from_day = $day->toDateString();
            $to_day = $day->addDays(28)->toDateString();;


        }

        $from_hour = '00:00:00';
        $to_hour = '23:59:59';

        $result = [];
        $chart_rows = DB::table('systems_records')
            ->select('temp2', 'hum', 'co2', 'temp1', 'date', 'error')
            ->where('system_id', '=', $selected_system->id)
            ->whereBetween('date', [$from_day.' '.$from_hour , $to_day . ' ' . $to_hour])
            ->get();


//        return $from_day . ' ' . $to_day;

        $today = today()->toDateString();


//        $result = [];
//        for ($i = 0; $i < 28; $i++) {
//            $now_day = $from_day->addDays(1)->toDateString();
//            array_push($result, $now_day . ' 00:00:00');
//        }
//
//        $chart_clocks = $result;
//
//
//        for ($x = 0; $x < 28; $x++) {
//            $from_d = $chart_clocks[$x];
//            $to_d = date('Y-m-d H:i:s', strtotime($from_d . " + 23 hours + 59 minutes"));
//
//            $temp1 = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('temp1');
//
//            $temp2 = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('temp2');
//
//            $hum = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('hum');
//
//            $co2 = DB::table('systems_records')->where('system_id', '=', $system_id)
//                ->whereBetween('date', [$from_d, $to_d])->avg('co2');
//
//            $error_count = DB::table('systems_records')
//                ->where('system_id', '=', $selected_system->id)
//                ->where('error', '=', 1)
//                ->whereBetween('date', [$from_d, $to_d])
//                ->count('error');
//
//            $ok_count = DB::table('systems_records')
//                ->where('system_id', '=', $selected_system->id)
//                ->where('error', '=', 0)
//                ->whereBetween('date', [$from_d, $to_d])
//                ->count();
//
//            $tables[$x] = new \stdClass();
//            $tables[$x]->time = $from_d;
//            $tables[$x]->temp1 = $temp1;
//            $tables[$x]->temp2 = $temp2;
//            $tables[$x]->hum = $hum;
//            $tables[$x]->co2 = $co2;
//            $tables[$x]->error = $error_count;
//            $tables[$x]->ok = $ok_count;
//
//        }
        foreach ($chart_rows as $i => $chart_row) {

            $tables[$i] = new \stdClass();
            $tables[$i]->time = $chart_row->date;
            $tables[$i]->temp1 = $chart_row->temp1;
            $tables[$i]->temp2 = $chart_row->temp2;
            $tables[$i]->hum = $chart_row->hum;
            $tables[$i]->co2 = $chart_row->co2;
            $tables[$i]->error = $chart_row->error;
            $tables[$i]->ok = $chart_row->error;

        }

        return $tables;
    }


    public function user_account(Request $request)
    {
        $user = $this->getUser($request);


        return view("account", [
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
            if (DB::table('users')->where('api_key', $token)->exists()) {
                $user = DB::table('users')->where('api_key', $token)->first();
                if ($user->user_type == 1) {
                    return \redirect()->route('admin_users');
                } elseif ($user->user_type == 2) {
                    return \redirect()->route('dashboard');
                } else {
                    return \redirect()->route('dashboard');
                }
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
        $day = today();

        if ($request->has('system_id')) {
            $system_id = \request()->input('system_id');
        }
        if ($request->has('day')) {
            try {
                $day = new Carbon(date('Y-m-d H:i:s', strtotime(request()->input('day'))));
            } catch (\Exception $e) {
            }
        }

//        return dd($day);
        if ($system_id == 0) {
            $user['selected_system'] = $user->systems->first();
        } else {
            $user['selected_system'] = $user->systems->find($system_id);
        }
        $user->selected_system['from_date'] = $day->toDateString();


        $charts = $this->getTodayChartRecords($user['selected_system'], $day);
        $last_charts = $this->getLastChartRecords($user['selected_system']);
        $week_charts = $this->getWeekChartRecords($user['selected_system'], $day);
        $month_charts = $this->getMonthChartRecords($user['selected_system'], $day);
//        $month_charts = $this->getLastChartRecords($user['selected_system']);
        $user->selected_system['today_charts'] = $charts;
        $user->selected_system['last_charts'] = $last_charts;
        $user->selected_system['week_charts'] = $week_charts;
        $user->selected_system['month_charts'] = $month_charts;


//        $system_id = $request->input('system_id');
//        $charts_type = $request->input('charts_type');
//        $start_date  =$request->input('start_date');
//        $end_date  =$request->input('end_date');


        return view("charts", [
            'user' => $user
        ]);
    }

    public function tables(Request $request)
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


        $from_day = today()->toDateString();
        $to_day = today()->toDateString();

        $from_hour = '00:00:00';
        $to_hour = '23:59:59';



        if ($request->has('day') && $request->has('to_day')) {
            try {
                $from_day = new Carbon(date('Y-m-d H:i:s', strtotime(request()->input('day'))));
                $to_day = new Carbon(date('Y-m-d H:i:s', strtotime(request()->input('to_day'))));
                $from_day = $from_day->toDateString();
                $to_day = $to_day->toDateString();
            } catch (\Exception $e) {

            }
        }


        $user->selected_system['from_date'] = $from_day;
        $user->selected_system['to_date'] = $to_day;

        $tables = [];

        $chart_rows = DB::table('systems_records')
            ->select('temp2', 'hum', 'co2', 'temp1', 'date', 'error')
            ->where('system_id', '=', $user->selected_system->id)
            ->whereBetween('date', [$from_day . ' ' . $from_hour, $to_day . ' ' . $to_hour])
            ->get();

        foreach ($chart_rows as $i => $chart_row) {

            $tables[$i] = new \stdClass();
            $tables[$i]->time = $chart_row->date;
            $tables[$i]->temp1 = $chart_row->temp1;
            $tables[$i]->temp2 = $chart_row->temp2;
            $tables[$i]->hum = $chart_row->hum;
            $tables[$i]->co2 = $chart_row->co2;
            $tables[$i]->error = $chart_row->error;
            $tables[$i]->ok = $chart_row->error;

        }


//        return $this->jsonResponse($today_tables ,200 );

//        $last_charts = $this->getLastChartRecords($user['selected_system']);
//        $week_charts = $this->getWeekChartRecords($user['selected_system'], today());
//        $month_charts = $this->getMonthChartRecords($user['selected_system'], today());


        $user->selected_system['table_values'] =$tables;
//        $user->selected_system['today_table'] = $this->getTodayTableRecords($user['selected_system'], $day);
//        $user->selected_system['last_table'] = $this->getLastTableRecords($user['selected_system']);
//        $user->selected_system['week_table'] = $this->getWeekTableRecords($user['selected_system'], $day);
//        $user->selected_system['month_table'] = $this->getMonthTableRecords($user['selected_system'], $day);
//        $user->selected_system['week_charts'] = $week_charts;
//        $user->selected_system['month_charts'] = $month_charts;


//        return $this->jsonResponse($user, 200);
        return view("tables", [
            'user' => $user
        ]);
    }


    public function check_login(Request $request)
    {

        $username = $request->get('username');
        $password = $request->get('password');

        if (DB::table('users')->where('username', $username)->where('password', $password)->exists()) {
            $user = DB::table('users')->where('username', $username)->where('password', $password)->first();
            if ($user->user_type == 1) {
                try {
                    $cookie = \cookie()->make('token', $user->api_key);
                } catch (BindingResolutionException $e) {
                }
                return redirect('/admin_users')->withCookie($cookie);

            } elseif ($user->user_type == 2) {
                if ($user->account_expire_time < today()) {
                    return redirect()->back()->with('status', 'زمان حساب کاربری شما تمام شده است  . برای تمدید حساب کاربری خود با مدیر سیستم تماس بگیرید .');

                } else {
                    try {
                        $cookie = \cookie()->make('token', $user->api_key);
                    } catch (BindingResolutionException $e) {
                    }
                    DB::table('login_log')->insert([
                        'user_id' => $user->id,
                        'ip' => $request->ip(),
                        'date' => today()
                    ]);

                    return redirect('/')->withCookie($cookie);
                }
            } else {
                return redirect()->back()->with('status', 'کاربری با این مشخصات وجود ندارد .');
            }
        } else {

            return redirect()->back()->with('status', 'نام کاربری یا رمز عبور اشتباه است !');
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
