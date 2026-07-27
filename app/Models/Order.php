<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'total_price',
        'code',
        'status',
        'transaction_id',
        'address_id',
        'user_id',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class,'order_id')->latest();
    }
}
