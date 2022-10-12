<?php


namespace Modules\Common\Filters;

use Closure;

class AreaPipeline
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('location')) {
            return $next($request);
        }
        return $next($request)->where('location->area', 'LIKE', '%' . request()->location . '%');
    }
}
