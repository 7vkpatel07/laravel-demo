<?php

namespace App\Http\Middleware;

use Closure;
use App\Modules;
use Session;
use Auth;
use DB;
class CheckModules
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $moduleId = 0;
        //return $next($request);
        Session::forget('module_id');
        //Redis::del('module_id');
        if (Auth::check()){

            $route = \Route::getCurrentRoute()->getPrefix();
            if(isset($route) && $route!=''){
                $routesExplode = explode('/', $route);
                $module = end($routesExplode);

                //$module = Modules::select('id')->where('name',$module)->first();
                $module = Modules::select('id')->where(DB::raw('lower(name)'), strtolower(trim($module)))->first();
                
                if(!empty($module) && isset($module->id) && $module->id!=''){
                    $moduleId = $module->id;
                }

            }

        }
        session(['module_id' => $moduleId]);
       
        return $next($request);
    }
}
