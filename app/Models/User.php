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
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
    
    static $rules = [
      'email' => 'required|string|unique:users,email',
      'name' => 'required|string',
      'password' => 'required|string|confirmed',
    ];

    static $message = [
      'name.required' => 'El nombre de usuario es requerido.',
      'email.required' => 'El email es requerido.',
      'email.unique' => 'El email ya está registrado.',
      'password.required' => 'La contraseña es requerida.',
      'password.confirmed' => 'Las contraseñas no coinciden.'
    ];

    protected $perPage = 20;
}