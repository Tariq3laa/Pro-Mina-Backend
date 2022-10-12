<?php

namespace Modules\Website\User\Repositories;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Modules\Common\Entities\Media;
use Modules\Website\User\Entities\Album;
use Modules\Common\Helpers\Traits\ApiPaginator;
use Modules\Website\User\Transformers\AlbumResource;

class AlbumRepository implements AlbumRepositoryInterface
{
    use ApiPaginator;

    public function index()
    {
        $data = app(Pipeline::class)
            ->send(auth('client')->user()->albums())
            ->through([
                \Modules\Common\Filters\PaginationPipeline::class,
            ])
            ->thenReturn();
        $collection = AlbumResource::collection($data);
        return $this->getPaginatedResponse($data, $collection);
    }

    public function store($request)
    {
        DB::beginTransaction();
        $model = Album::query()->create($request->validated());
        DB::commit();
        return ['id' => $model->id];
    }

    public function show($request)
    {
        $model = Album::query()->find($request->album);
        if(auth('client')->id() != $model->client_id) throw new \Exception('Only the creator of the album can view the album.');
        return new AlbumResource($model);
    }

    public function update($request)
    {
        DB::beginTransaction();
        Album::query()->where('id', $request->album)->update($request->only(['name']));
        DB::commit();
        return 'Album updated successfully .';
    }

    public function destroy($request)
    {
        Album::query()->where('id', $request->album)->delete();
        return 'Album Deleted Successfully .';
    }

    public function move($request, $source, $destination)
    {
        Media::query()->where('album_id', $source)->update(['album_id' => $destination]);
        Album::query()->where('id', $source)->delete();
        return 'Album Deleted Successfully .';
    }

    public function getDropDownData($id)
    {
        $data = Album::query()->where([
            ['id', '<>', $id],
            ['client_id', '=', auth('client')->id()],
        ])->get();
        return AlbumResource::collection($data);
    }
}