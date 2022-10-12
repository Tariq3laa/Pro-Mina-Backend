<?php

namespace Modules\Common\Filters;

use Illuminate\Database\Query\Builder;
use \Illuminate\Pipeline\Pipeline as Pipe;

class Pipeline
{
    private $pipelines = [];
    private $query;

    public function pushPipeline(Builder $query, PipelineFactory $pipeline)
    {
        array_push($this->pipelines, $pipeline);
        $this->query = $query;
        return $this;
    }

    public function resetPipelines()
    {
        $this->pipelines = [];
    }

    public function then()
    {
        return app(Pipe::class)
            ->send($this->query)
            ->through($this->pipelines)
            ->thenReturn();
    }

    public function __call(string $name, array $arguments)
    {
        $result = $this->then()
            ->$name(...$arguments);
        
        $this->resetPipelines();
        return $result;
    }

}
