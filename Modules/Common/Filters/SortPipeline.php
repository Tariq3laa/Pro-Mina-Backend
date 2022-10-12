<?php


namespace Modules\Common\Filters;

use Closure;

class SortPipeline
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('sort')) {
            return $next($request);
        }
        return $next($request)->orderBy($request->sort['key'], $request->sort['type']);
    }
}
