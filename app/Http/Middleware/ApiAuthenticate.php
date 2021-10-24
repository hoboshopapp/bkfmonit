<?php


namespace App\Http\Middleware;


use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->hasCookie('token')) {
            $token = $request->cookie('token');
            if (DB::table('users')->where('api_key' , $token)){
                return $next($request);
            }else{
                return redirect()->route('login');

            }
        }else{
            return redirect()->route('login');
        }


        //        return request('name');

    }
}
