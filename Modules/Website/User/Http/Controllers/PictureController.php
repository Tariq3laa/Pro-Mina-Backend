<?php

namespace Modules\Website\User\Http\Controllers;

use Modules\Website\User\Services\PictureService;
use Modules\Website\User\Http\Requests\Album\Picture\PictureRequest;

class PictureController
{
    private $service;

    public function __construct(PictureService $service)
    {
        $this->service = $service;
    }

    public function store(PictureRequest $request)
    {
        return $this->service->store($request);
    }
}
