<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Color\CreateColorRequest;
use App\Http\Requests\Color\EditColorRequest;
use App\Http\Resources\ColorResource;
use App\Http\Services\Keys;
use App\Models\Color;
use App\Models\Property;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class TestController extends Controller
{
    use ApiResponse;

    public function index()
    {
        return self::success(__('api.color.index'),
            [
                Keys::color => Color::getAllColorsResource(),
            ], 200);
    }

    public function store(CreateColorRequest $request)
    {
        $color = Color::createColor($request);

        return self::success(__('api.color.store'),
            [
                Keys::color => new ColorResource($color),
            ], 201);
    }


    public function show(string $id)
    {
        $color = Color::getColor($id);

        return self::success(__('api.color.show'),
            [
                Keys::color => new ColorResource($color),
            ], 200
        );
    }


    public function update(EditColorRequest $request, string $id)
    {
        $color = Color::getColor($id);
        $color_update = Color::updateColor($request, $color);

        return self::success(__('api.color.update'),
            [
                Keys::color => new ColorResource($color_update),
            ], 200);
    }


    public function destroy(string $id)
    {
        $color = Color::getColor($id);
        $color->delete();

        return self::success(__('api.color.destroy'),
            [
                Keys::color => new ColorResource($color),
            ], 200);
    }
}
