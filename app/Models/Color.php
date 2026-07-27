<?php

namespace App\Models;

use App\Http\Resources\ColorResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Color extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'color',
    ];


    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class,'color_products');
    }

    public function basketDetails(): HasMany
    {
        return $this->hasMany(BasketDetails::class, 'color_id');
    }


    public static function getAllColors()
    {
        return self::query()->paginate(15);
    }

    public static function getColor($id)
    {
        return self::query()->findOrFail($id);
    }

    public static function getAllColorsResource()
    {
        $colors = self::query()->get();
        return ColorResource::collection($colors);
    }


    public static function createColor($request)
    {
        return  $colors = self::query()->create([
            'title' => $request->title,
            'color' => $request->color,
        ]);
    }


    public static function updateColor($request,$color)
    {
        $color->update([
            'title' => $request->title,
            'color' => $request->color,
        ]);

        // اگر از همان مدل استفاده کنید، معمولاً باید مقادیر جدید را داشته باشد.
        return $color->refresh();
    }
}


