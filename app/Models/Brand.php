<?php

namespace App\Models;

use App\Http\Resources\BrandResourse;
use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'photo',
    ];


    public static function getAllBrandsResource()
    {
        $brands = self::query()->get();
        return BrandResourse::collection($brands);
    }


    public static function saveImage($request)
    {
        if($request){
            $filename = uniqid() . '.' . $request->extension();
            $request->move(public_path('admin/brand'), $filename);
            return $filename;
        }
        return null;
    }


    public static function getAllBrends()
    {
        return self::query()->paginate(15);
    }


    public static function createBrand($request)
    {
        $image = self::saveImage($request->photo);
        self::query()->create([
            'title' => $request->title,
            'photo' => $image,
        ]);
    }


    public static function updateBrand($request,$brand)
    {
        $picture = public_path('admin/brand/' . $brand->photo);
        if ($request->hasfile('photo')) {
            File::exists($picture);
            File::delete($picture);
            $image = self::saveImage($request->photo);
        }else{
            $image = $brand->photo;
        }

        $brand->update([
            'title' => $request->title,
            'photo' => $image,
        ]);
    }
}
