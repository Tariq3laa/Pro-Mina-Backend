<?php

namespace Modules\Website\User\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Website\User\Services\AlbumService;
use Modules\Website\User\Http\Requests\Album\AlbumRequest;

class AlbumController
{
    private $service;

    public function __construct(AlbumService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return $this->service->index();
    }

    public function store(AlbumRequest $request)
    {
        return $this->service->store($request);
    }

    public function show(AlbumRequest $request)
    {
        return $this->service->show($request);
    }

    public function update(AlbumRequest $request)
    {
        return $this->service->update($request);
    }

    public function destroy(AlbumRequest $request)
    {
        return $this->service->destroy($request);
    }

    public function move(Request $request, $source, $destination)
    {
        return $this->service->move($request, $source, $destination);
    }

    public function getDropDownData($id)
    {
        return $this->service->getDropDownData($id);
    }
}
