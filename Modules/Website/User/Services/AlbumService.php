<?php

namespace Modules\Website\User\Services;

use Illuminate\Support\Facades\DB;
use Modules\Common\Http\Controllers\InitController;
use Modules\Website\User\Repositories\AlbumRepository;

class AlbumService extends InitController
{
    private $repository;

    public function __construct(AlbumRepository $repository)
    {
        parent::__construct();
        $this->repository = $repository;
    }

    public function index()
    {
        try {
            return $this->respondWithSuccess($this->repository->index());
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function store($request)
    {
        try {
            return $this->respondCreated($this->repository->store($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function show($request)
    {
        try {
            return $this->respondWithSuccess($this->repository->show($request));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }

    public function update($request)
    {
        try {
            return $this->respondOk($this->repository->update($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function destroy($request)
    {
        try {
            return $this->respondOk($this->repository->destroy($request));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function move($request, $source, $destination)
    {
        try {
            return $this->respondOk($this->repository->move($request, $source, $destination));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->respondError($e->getMessage());
        }
    }

    public function getDropDownData($id)
    {
        try {
            return $this->respondWithSuccess($this->repository->getDropDownData($id));
        } catch (\Exception $e) {
            return $this->respondError($e->getMessage());
        }
    }
}