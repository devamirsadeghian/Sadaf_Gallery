<?php

namespace App\Models;

use App\Http\Resources\PropertyResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class Property extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'title',
        'property_group_id',
    ];


    public function property_group(): BelongsTo
    {
        return $this->belongsTo(PropertyGroup::class,'property_group_id','id');
    }




    public static function getAllProperties()
    {
        return self::query()->paginate(15);
    }

    public static function getProperty($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function getAllPropertiesResource()
    {
        $properties = self::query()->get();
        return PropertyResource::collection($properties);
    }

    public static function getPropertyResource($id)
    {
        $property = self::query()->get();
        return PropertyResource::collection($property);
    }


    public static function createProperty($request)
    {
        self::query()->create([
            'title' => $request->title,
            'property_group_id' => $request->property_group_id,
        ]);
    }


    public static function updateProperty($request,$user)
    {
        $user->update([
            'title' => $request->title,
            'property_group_id' => $request->property_group_id,
        ]);
    }


//    public static function createPropertyResource($request)
//    {
//        self::query()->create([
//            'title' => $request->title,
//            'property_group_id' => $request->property_group_id,
//        ]);
//    }
}
