<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class RoleMiddleware {

	public function __construct(Guard $auth){
		$this->auth = $auth;
	}
	
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest()){
			if ($request->ajax()){
				return response('Unauthorized.', 401);
			}else{
				return redirect()->guest('cauth/login');
			}
		}

		if (Auth::check() && !Auth::user()->hasRole('admin')){
			return view('errors.error_access');
	        //return abort(401, 'Unauthorized');
	    }
		
		return $next($request);
	}

}
