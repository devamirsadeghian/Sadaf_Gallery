<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\Keys;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class UserApiController extends Controller
{
    public function register(CreateUserRequest $request)
    {
        $user = User::createUser($request);

        return $this->success( __('api.auth.register'),[
            Keys::user => new UserResource($user),
        ], 201);
    }



    public function profile(Request $request)
    {
        $user = auth()->user();

        return $this->success( __('api.auth.profile'),[
            Keys::user => new UserResource($user),
            Keys::user_processing_count => UserRepository::processingUserOrderCount($user),
            Keys::user_received_count => UserRepository::receivedUserOrderCount($user),
            Keys::user_rejected_count => UserRepository::rejectedUserOrderCount($user),
        ], 200);
    }


    public function received_orders()
    {
        $user = auth()->user();

        return $this->success( __('api.products.received_orders'),[
            'data' => UserRepository::receivedUserOrderCount($user),
        ], 200);
    }
}
