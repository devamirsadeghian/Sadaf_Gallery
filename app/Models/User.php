<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UsersStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'user_name',
        'email',
        'phone',
        'mobile',
        'password',
        'photo',
        'is_admin',
        'status',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class,'user_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(comment::class,'user_id');
    }


    public function basket(): HasOne
    {
        return $this->hasOne(Basket::class)->where('is_ordered',false);
    }



    public static function changeUserStatus($id)
    {
        $user = User::query()->find($id);
        if ($user->status == UsersStatus::active->value) {
            $user->update([
                'status' => UsersStatus::Inactive->value
            ]);
        } else {
            $user->update([
                'status' => UsersStatus::active->value
            ]);
        }
    }


    public static function saveImage($request)
    {
        if($request){
            $filename = uniqid() . '.' . $request->extension();
            $request->move(public_path('admin/user/'), $filename);
            return $filename;
        }
        return null;
    }


    public static function getAllUsers()
    {
        return self::query()->paginate(15);
    }

    public static function getUser($id)
    {
        return self::query()->findOrFail($id);
    }


    public static function createUserByAdmin($request)
    {
        if ($request->hasFile('photo')){
            $image = self::saveImage($request->file('photo'));
        }else{
            $image = null;
        }
        return  self::query()->create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'photo' => $image,
        ]);
    }


    public static function updateUserByAdmin($request, $user)
    {
        $picture = public_path('admin/user/' . $user->photo);
        if ($request->hasfile('photo')) {
            File::exists($picture);
            File::delete($picture);
            $image = self::saveImage($request->file('photo'));
        }else{
            $image = $user->photo;
        }

        $user->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'mobile' => $request->mobile,
            'phone' => $request->phone ?? null,
            'password' => $request->password ? Hash::make($request->password) : $user->password ,
            'photo' => $image,
        ]);
    }


    public static function createUser($request)
    {
        return  self::query()->create([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);
    }



    public static function updateUser($request,$user)
    {
        $picture = public_path('admin/user/' . $user->photo);
        if ($request->hasfile('photo')) {
            File::exists($picture);
            File::delete($picture);
            $image = self::saveImage($request->file('photo'));
        }else{
            $image = $user->photo;
        }

        $user->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'mobile' => $request->mobile,
            'phone' => $request->phone ?? null,
            'password' => $request->password ? Hash::make($request->password) : $user->password ,
            'photo' => $image,
        ]);
    }


    public static function updateUserInfo($request, $user)
    {
        $picture = public_path('admin/user/' . $user->photo);
        if ($request->hasfile('photo')) {
            File::exists($picture);
            File::delete($picture);
            $image = self::saveImage($request->photo);
        }else{
            $image = $user->photo;
        }

        $user->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
            'phone' => $request->phone,
            'photo' => $image,
        ]);

        $user->address()-> create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'lat' => $request->lat,
            'lang' => $request->lang,
        ]);
    }

    public static function findWithMobile($mobile)
    {
        return self::query()->where('mobile',$mobile)->first();
    }
}
