<?php

namespace App\Models;

use App\Enums\ContactStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'mobile',
        'subject',
        'text',
        'status',
    ];

    public static function getAllUserContactMessages()
    {
        return self::query()->where('status',ContactStatus::unread->value)->count();
    }


    public static function getContact($id)
    {
        return self::query()->findOrFail($id);
    }

    public static function getAllContact()
    {
        return self::query()->orderBy('created_at', 'desc')->paginate(20);
    }


    public static function storeContact($request)
    {
        self::query()->create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'subject' => $request->subject,
            'text' => $request->text,
        ]);
    }
}
