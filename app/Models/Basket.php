<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basket extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=[
        'status',
        'user_id',
        'code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function items(): HasMany
    {
        return $this->hasMany(BasketDetails::class);
    }

    public static function getDraftBasket($userId)
    {
        return self::where('user_id', $userId)
            ->where('status', \App\Enums\BasketStatus::draft->value)
            ->first();
    }


    public static function createBasket($userId)
    {
        return self::firstOrCreate(
            [
                'user_id' => $userId,
                'status' => \App\Enums\BasketStatus::draft->value,
                'code' => rand(10000, 99999),
            ],
        );
    }
}
