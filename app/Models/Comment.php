<?php

namespace App\Models;

use App\Enums\CommentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'body',
        'rate',
        'status',
        'user_id',
        'product_id',
        'parent_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }




    public static function getAllUserCommentDraft()
    {
        return self::query()
            ->where('parent_id',null)
            ->where('status',CommentStatus::draft->value)->count();
    }


    public static function getAllUserComment()
    {
        return self::query()
            ->where('parent_id',null)
            ->orderByRaw("status = ? DESC", [CommentStatus::draft->value])->paginate(15);
    }

    public static function getAllAdminComment()
    {
        return self::query()
            ->whereNot('parent_id',null)
            ->orderByRaw("status = ? DESC", [CommentStatus::draft->value])->paginate(15);
    }

    public static function getComment($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function createUserComment($request, $user, $product)
    {
        return self::create([
            'body' => $request->input('body'),
            'rate' => $request->input('rate'),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'parent_id' => null,
        ]);
    }

    public static function createAdminComment($request, $admin, $comment)
    {
        return self::create([
            'body'       => $request->body,
            'status'     => CommentStatus::accept,
            'rate'       => null,
            'user_id'    => $admin,
            'product_id' => $comment->product_id,
            'parent_id'  => $comment->id,
        ]);
    }


}
