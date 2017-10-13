<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
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
        if(!p(request()->path(), request()->method()) && !p(request()->route()->uri(), request()->method())){
            if(request()->method() == 'POST' || request()->wantsJson())
                return response ()->json(['code'=>403, 'message'=>'Bạn không có quyền truy cập chức năng này']);
            else
                return response(v('errors.403'));
        }
        else
            return $next($request);
    }
}
