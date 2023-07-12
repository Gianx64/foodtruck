<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'name', 'email', 'password' ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany('App\Models\Event', 'owner', 'email');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foodtrucks()
    {
        return $this->hasMany('App\Models\Foodtruck', 'event_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function foodtrucksAccepteds()
    {
        return $this->hasMany('App\Models\FoodtrucksAccepted', 'event_id', 'id');
    }

    static $rules = [
      'email' => 'required|string|email|max:255|unique:users,email',
      'name' => 'required|string|max:255',
      'password' => 'required|string|min:8|confirmed',
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