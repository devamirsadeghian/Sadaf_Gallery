<?php


namespace App\Models;


use App\Http\Resources\CommentResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title_fa',
        'title_en',
        'price',
        'review',
        'count',
        'sold',
        'photo',
        'guaranty',
        'discount',
        'description',
        'is_special',
        'special_expiration',
        'status',
        'category_id',
        'brand_id',
        'colors',
    ];

//    protected $appends = ['discount_percent'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }


    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(Color::class,'color_products');
    }


    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class,'product_id');
    }


    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class,'product_id');
    }




    public function getDiscountPercentAttribute()
    {
        if ($this->discount || $this->price <= 0) {
            return round(($this->discount / $this->price) * 100);
        }
        return 0;
    }

    public function getAverageRateAttribute()
    {
        return round($this->comments()->avg('rate'), 1);
    }


    public static function saveImage($request)
    {
        if($request){
            $filename = uniqid() . '.' . $request->extension();
            $request->move(public_path('admin/product/'), $filename);
            return $filename;
        }
        return null;
    }


    public static function getAllProducts()
    {
        return self::query()->paginate(12);
    }

    public static function getProduct($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function createProduct($request)
    {
        $image = self::saveImage($request->photo);
        $product = self::query()->create([
            'title_fa' => $request->title_fa,
            'title_en' => $request->title_en,
            'price' => $request->price,
            'count' => $request->count,
            'guaranty' => $request->guaranty,
            'discount' => ($request->discount ?? 0 ),
            'description' => $request->description,
            'is_special' => ($request->is_special ? true : false),
            'special_expiration' => $request->special_expiration,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'photo' => $image,
        ]);
        $product->colors()->attach($request->colors);
    }


    public static function updateProduct($request,$product)
    {
        $picture = public_path('admin/product/' . $product->photo);
        if ($request->hasfile('photo')) {
            File::exists($picture);
            File::delete($picture);
            $image = self::saveImage($request->photo);
        }else{
            $image = $product->photo;
        }

        $product->update([
            'title_fa' => $request->title_fa,
            'title_en' => $request->title_en,
            'price' => $request->price,
            'count' => $request->count,
            'guaranty' => $request->guaranty,
            'discount' => ($request->discount ?? 0 ),
            'description' => $request->description,
            'is_special' => ($request->is_special ? true : false),
            'special_expiration' => $request->special_expiration,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'photo' => $image,
        ]);

        $product->colors()->sync($request->colors);
    }


    public static function filterProducts(Request $request, $perPage = 12)
    {
        $query = Product::query();
        $finalPrice = '(price - discount)';

        // جستجو
        $search = trim($request->input('search', ''));
        if ( $search !== '' ) {
            $query->where(function ($q) use ($search) {

                $q->where('title_fa', 'like', "%{$search}%")
                    ->orWhere('title_en', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // دسته بندی
        $categories = $request->input('category', []);
        if (!empty($categories)) {
            $query->whereIn('category_id', $categories);
        }


        // حداقل قیمت
        if ($request->filled('min_price')) {
            $query->whereRaw("$finalPrice >= ?", [$request->min_price]);
        }

        // حداکثر قیمت
        if ($request->filled('max_price')) {
            $query->whereRaw("$finalPrice <= ?", [$request->max_price]);
        }

        // فقط موجود
        if ($request->filled('available')) {
            $query->where('count', '>', 0);
        }

        // فقط ویژه
        if ($request->filled('is_special')) {
            $query->where('is_special', 1);
        }



        switch ($request->sort) {
            case 'newest':
                $query->orderBy('created_at', 'DESC');
                break;

            case 'most_sold':
                $query->orderBy('sold', 'DESC');
                break;

            case 'most_viewed':
                $query->orderBy('review', 'DESC');
                break;

            case 'cheapest':
                $query->orderByRaw("$finalPrice ASC");
                break;

            case 'expensive':
                $query->orderByRaw("$finalPrice DESC");
                break;

            case 'discount':
                $query->where('price', '>', 0)->orderByRaw('(discount / price) DESC');
                break;

            default:
                $query->latest();
        }
        return $query->paginate($perPage);
    }
}


