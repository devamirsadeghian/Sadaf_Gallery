<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Gallery extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'photo',
        'product_id',
    ];


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    public static function getAllGalleries()
    {
        return self::query()->paginate(15);
    }

    public static function getGallery($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function getProductGallery($id)
    {
        return self::query()->where('product_id',$id)->get();
    }


    public static function saveImage($request)
    {
        if($request){
            $filename = uniqid() . '.' . $request->extension();
            $request->move(public_path('admin/gallery/'), $filename);
            return $filename;
        }
        return null;
    }

    public static function createGallery($request)
    {
        $image = self::saveImage($request->photo);
        self::query()->create([
            'product_id' => $request->product_id,
            'photo' => $image,
        ]);
    }
}
