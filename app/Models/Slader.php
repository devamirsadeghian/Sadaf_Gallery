<?php

namespace App\Models;

use App\Http\Resources\SliderResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Slader extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'url',
        'photo',
    ];


    public static function saveImage($request)
    {
        if($request){
            $filename = uniqid() . '.' . $request->extension();
            $request->move(public_path('admin/slider'), $filename);
            return $filename;
        }
        return null;
    }


    public static function getAllSlidersResource()
    {
        $sliders = self::query()->get();
        return SliderResource::collection($sliders);
    }


    public static function getAllSliders()
    {
        return self::query()->paginate(15);
    }


    public static function getSlider($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function createSlider($request)
    {
        $image = self::saveImage($request->photo);
        self::query()->create([
            'title' => $request->title,
            'url' => $request->url,
            'photo' => $image,
        ]);
    }


    public static function updateSlider($request, $slider)
    {
        $picture = public_path('admin/slider/' . $slider->photo);
        if ($request->hasfile('photo')) {
            File::exists($picture);
            File::delete($picture);
            $image = self::saveImage($request->photo);
        }else{
            $image = $slider->photo;
        }

        $slider->update([
            'title' => $request->title,
            'url' => $request->url,
            'photo' => $image,
        ]);
    }
}
