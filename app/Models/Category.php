<?php

namespace App\Models;

use App\Http\Resources\CategoryResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'photo',
        'parent_id',
    ];


    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class,'parent_id','id')->withDefault(['title' => '----']);
    }


    public function child(): HasMany
    {
        return $this->hasMany(self::class,'parent_id','id');
    }


    public static function saveImage($request)
    {
        if($request){
            $filename = uniqid() . '.' . $request->extension();
            $request->move(public_path('admin/category'), $filename);
            return $filename;
        }
        return null;
    }


    public static function getAllCategoriesResource()
    {
        $categories = Category::query()->get();
        return CategoryResource::collection($categories);
    }


    public static function getAllCategories()
    {
        return self::query()->paginate(15);
    }


    public static function getCategory($id)
    {
        return self::query()->findOrFail($id);
    }

    public static function get3FirstCategory()
    {
        return  self::take(3)->get();
    }


    public static function createCategory($request)
    {
        $image = self::saveImage($request->photo);
        self::query()->create([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'photo' => $image,
        ]);
    }


    public static function updateCategory($request, $category)
    {
        $picture = public_path('admin/category/' . $category->photo);
        if ($request->hasfile('photo')) {
            File::exists($picture);
            File::delete($picture);
            $image = self::saveImage($request->photo);
        }else{
            $image = $category->photo;
        }

        $category->update([
            'title' => $request->title,
            'parent_id' => $request->parent_id,
            'photo' => $image,
        ]);
    }
}
