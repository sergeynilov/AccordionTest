<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
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
     * The attributes that should be cast.
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

    /**
     * returns related CMS items(by author_id field in CMSItem model)
     */
    public function CMSItems()
    {
        return $this->hasMany('App\Models\CMSItem', 'author_id', 'id');
    }

    /**
     * returns related claims(by author_id field in  model)
     */
    public function claims()
    {
        return $this->hasMany('App\Models\by author_id field in ', 'author_id', 'id');
    }

    public static function getUserValidationRulesArray($user_id, array $skipFieldsArray = []): array
    {
        $validationRulesArray = [
            'name'       => 'required|max:255|min:2|unique:' . with(new User)->getTable(),
            'email'      => 'required|email|max:255|unique:' . with(new User)->getTable(),
            'password'   => 'required|min:8|max:15',
            'password_confirmation' => 'required|min:8|max:15|same:password',
        ];

        foreach ($skipFieldsArray as $next_field) {
            if (!empty($validationRulesArray[$next_field])) {
                unset($validationRulesArray[$next_field]);
            }
        }

        return $validationRulesArray;
    } // public static function getUserValidationRulesArray($user_id) : array


}
