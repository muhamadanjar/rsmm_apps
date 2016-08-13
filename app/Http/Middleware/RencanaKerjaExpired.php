<?php namespace App\Http\Middleware;

use Closure;

class RencanaKerjaExpired {

	
	public function handle($request, Closure $next){
		dd($request->input('date_now'));
		if ($request->input('date_now') == ''){
            //return redirect(‘routeFullOfCuteKittenPics’);
        }

		$response = $next($request);

		return $response;
		//dd($request);
		//dd($request);
		/*$date_ex = date('2016-05-03 16:37:00');
		if ($date_ex < date('Y-m-d H:i:s')) {
			return response('Sudah Batas Waktu.', 401);
		}*/
		//return $next($request);
	}

}
