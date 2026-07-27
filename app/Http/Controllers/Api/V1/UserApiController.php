<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\UserRepository;
use App\Http\Resources\UserResource;
use App\Http\Services\Keys;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class UserApiController extends Controller
{
    public function register(Request $request)
    {
        $user = Auth()->user();

        if ($user){
            User::updateUserInfo($request,$user);

            return $this->success([
                Keys::user => new UserResource($user),
            ],
                'user updated',
                201);
        }else{
            return $this->error(
                'user not found', 403);
        }
    }



    public function profile(Request $request)
    {
        $user = auth()->user();

        return $this->success([
            Keys::user => new UserResource($user),
            Keys::user_processing_count => UserRepository::processingUserOrderCount($user),
            Keys::user_received_count => UserRepository::receivedUserOrderCount($user),
            Keys::user_rejected_count => UserRepository::rejectedUserOrderCount($user),
        ],
            'user profile',
            200);
    }


    public function received_orders()
    {
        $user = auth()->user();

        return $this->success([
            'data' => UserRepository::receivedUserOrderCount($user),
        ],
            'user received',
            200);
    }
}
