<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ProductRepository;
use App\Http\Resources\UserResource;
use App\Http\Services\Keys;
use App\Models\Category;
use App\Models\Slader;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class HomeApiController extends Controller
{
    public function home() {

        return $this->success(__('api.products.home'),[
            Keys::sliders => Slader::getAllSlidersResource(),
            Keys::categories => Category::getAllCategoriesResource(),
            Keys::amazing_product => ProductRepository::get6AmazingProducts(),
            Keys::banner => Slader::query()->inRandomOrder()->first(),
            Keys::most_seller_products => ProductRepository::get6MostSellerProducts(),
            Keys::newest_products => ProductRepository::get6NewestProducts(),
        ],
        200);
    }
}
