<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public static function hasFoodtruck() {
        return DB::table('foodtrucks')->where('user_id', auth()->user()->id)->exists();
    }

    static $rules = [
      'email' => 'required|string|email|max:255|unique:users,email',
      'name' => 'required|string|max:255',
      'password' => 'required|string|min:8|confirmed'
    ];

    static $message = [
      'name.required' => 'An user name is required.',
      'email.required' => 'An email is required.',
      'email.unique' => 'This email is already registered.',
      'password.required' => 'A password is required.',
      'password.confirmed' => 'Passwords do not match.'
    ];

    protected $table = 'users';

    public $timestamps = true;
}
