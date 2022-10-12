<?php

namespace Modules\Common\Filters;

use Closure;

class RangePipeline
{
    public function handle($request, Closure $next)
    {
        $keys = request()->all();
        $result = array_filter(array_keys($keys), function ($key) {
            return strpos($key, '_range') !== false;
        });
        $query = $next($request);
        if (count($result)) {
            foreach ($result as $range) {
                $column_name = str_replace('_range', '', $range);
                $values = explode('-', $keys[$range]);
                $query->whereBetween($column_name, [$values[0], $values[1]]);
            }
            return $query;
        } else {
            return $next($request);
        }
    }
}
