<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\UserStatus;
use App\Models\Address;
use Laravel\Jetstream\HasTeams;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\HasApiTokens;
use Intervention\Image\Facades\Image;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    protected $guard_name = 'sanctum';

    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'profile_photo_path',
        'phone',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function user_status($status)
    {
        switch ($status) {
            case UserStatus::Active:
                return "فعال";
                break;
            case UserStatus::InActive:
                return "غیرفعال ";
                break;
            default:
                return "نامشخص";
                break;
        }
    }

    public function updateProfilePhoto(UploadedFile $photo)
    {
        tap($this->profile_photo_path, function ($previous) use ($photo) {
            $this->forceFill([
                'profile_photo_path' => Storage::disk('public')->put('user_profile', $photo)
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }


    public function addresses(){
        return $this->hasMany(Address::class)->orderBy('id','DESC');
    }

    public static function saveImage($file): string
    {
        if($file){
            $name = time() .'.'. $file->extension();
            $smallImage = Image::make($file->getRealPath());
            $bigImage = Image::make($file->getRealPath());

            $smallImage->resize(256, 256, function ($constraint) {
                $constraint->aspectRatio();
            });

            Storage::disk('local')->put('user_profile/small/' . $name, (string)$smallImage->encode('png', 90));
            Storage::disk('local')->put('user_profile/big/' . $name, (string)$bigImage->encode('png', 90));

            return $name;
        }else{
            return "";
        }
    }

    public static function updateRegisteredUser($user,$request,$image){
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'profile_photo_path' => $image
        ]);
        $user->addresses()->create([
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'lat' => $request->lat,
            'lng' => $request->lng,
        ]);
    }
}
