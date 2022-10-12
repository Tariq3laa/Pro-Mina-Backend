<?php

namespace Modules\Website\User\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Modules\Website\User\Entities\Client;
use Modules\Website\User\Transformers\ClientResource;
use Modules\Website\User\Repositories\AuthRepositoryInterface;

class AuthRepository implements AuthRepositoryInterface
{
    public function login($request)
    {
        $credentials = $request->only(['email', 'password']);
        $item = Client::query()->where('email', $request->email)->first();
        if (!$item['access_token'] = Auth::guard('client')->attempt($credentials, true)) throw new \Exception('The email or password you entered is invalid.', 401);
        return new ClientResource($item);
    }

    public function register($request)
    {
        DB::beginTransaction();
        $item = Client::query()->create($request->validated());
        DB::commit();
        $item['access_token'] = Auth::guard('client')->attempt($request->only(['email', 'password']), true);
        return new ClientResource($item);
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return 'Successfully logged out';
    }
}