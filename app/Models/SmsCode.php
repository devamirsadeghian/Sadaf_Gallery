<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsCode extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'mobile',
        'code',
    ];

    public static function ckeckTwoMinute($mobile)
    {
        $check = self::query()
            ->where('mobile', $mobile)
            ->where('created_at', '>', Carbon::now()->subMinute(2))
            ->first();

        if ($check) {
            return false;
        }
        return true;
    }

    public static function createSmsCode($mobile,$code)
    {
        SmsCode::query()->create([
            'mobile' =>$mobile,
            'code' =>$code,
        ]);
    }

    public static function checkSend($mobile, $code)
    {
        return self::query()
            ->where('mobile', $mobile)
            ->where('code', $code)
            ->exists();
    }
}
