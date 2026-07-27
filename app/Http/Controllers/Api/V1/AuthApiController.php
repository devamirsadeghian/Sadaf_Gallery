<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\SmsCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponse;

class AuthApiController extends Controller
{

    public function send_sms(Request $request)
    {
        $mobile = $request->input('mobile');
        $checkLastSms = SmsCode::ckeckTwoMinute($mobile);
        if($checkLastSms){
            $code = rand(1111,9999);
            SmsCode::createSmsCode($mobile,$code);

            return $this->success(__('api.products.send_sms_success'),[
                'mobile' => $mobile,
                'code' => $code,
            ],201);
        }else{
            return $this->error(__('api.products.send_sms_error'),403);
        }
    }


    public function verify_sms(Request $request)
    {
        $mobile = $request->input('mobile');
        $code = $request->input('code');

        $check = SmsCode::checkSend($mobile,$code);    //  check mobile
        if ($check){
            $user = User::query()->where('mobile',$mobile)->first();

            if ($user){
                return $this->success(__('api.products.verify_sms_success'),[
                    'id' => $user->id,
                    'token' => $user->createToken('new token')->plainTextToken
                ],201);
            }else{
                self::class::send_sms();
//                $user = User::query()->create([
//                    'mobile' => $mobile,
//                ]);

                return $this->error(__('api.products.verify_sms_error'),403);
            }
        }
    }
}

