<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;

class PropertyGroup extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =[
        'title',
    ];


    public function property(): HasMany
    {
        return $this->hasMany(Property::class);
    }



    public static function getAllPropertyGroups()
    {
        return self::query()->paginate(15);
    }


    public static function getPropertyGroup($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function createPropertyGroup($request)
    {
        self::query()->create([
            'title' => $request->title,
        ]);
    }


    public static function updatePropertyGroup($request,$propertyGroup)
    {
        $propertyGroup->update([
            'title' => $request->title,
        ]);
    }
}
