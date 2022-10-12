<?php


namespace Modules\Common\Filters;

use Closure;

class KeyRelationSearchPipeline
{
    public function handle($request, Closure $next)
    {
        if (!request()->has('keyword')) {
            return $next($request);
        }
        $query = $next($request);
        $relations = $query->getModel()->searchrelation;
        $keyword = request()->keyword;
        if ($relations && count($relations) && $relations[0]) {
            foreach ($relations as $relation) {
                $query->orWhereHas($relation['name'], function ($q) use ($keyword, $relation) {
                    return $q->where($relation['key'], 'LIKE', '%' . $keyword . '%');
                });
            }
            
        } 
        return $query;
    }
}
