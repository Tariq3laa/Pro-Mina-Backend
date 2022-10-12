<?php

namespace Modules\Website\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\Common\Http\Controllers\InitController;
use Modules\Website\User\Repositories\PictureRepository;

class PictureService extends InitController
{
    private $repository;

    public function __construct(PictureRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function store($request)
    {
        try {
            return $this->respondCreated($this->repository->albumUpload($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }
}