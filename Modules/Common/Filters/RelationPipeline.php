<?php


namespace Modules\Common\Filters;

use Closure;

class RelationPipeline
{
    public function handle($request, Closure $next)
    {
        $conditions = request()->all();
        $relation_ids = array_filter(array_keys($conditions), function ($key) {
            return strpos($key, '_ids') !== false;
        });
        $query = $next($request);
        if (count($relation_ids)) {
            foreach ($relation_ids as $id) {
                $relation_value_ids = explode(',', $conditions[$id]);
                $many_to_many_relation = str_replace('_ids', 's', $id);
                $one_to_many_relation = str_replace('_ids', '', $id);
                $id = strpos($id, 'ies_ids') !== false ? str_replace('ies_ids', 'y_id', $id) : str_replace('ids', 'id', $id);
                $relation_name = method_exists($query->getModel(), $many_to_many_relation) ? $many_to_many_relation : $one_to_many_relation;
                $query->whereHas($relation_name, function ($q) use ($relation_value_ids, $id) {
                    return $q->whereIn($id, $relation_value_ids);
                });
            }
            return $query;
        } else {
            return $next($request);
        }
    }
}
