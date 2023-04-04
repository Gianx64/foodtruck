<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foodtruck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'event_id', 'name', 'plate', 'owner', 'food', 'description'
    ];

    public $timestamps = true;

    static $rules = [
        'name' => 'required|string',
        'plate' => 'required|string|min:6|max:8|unique:foodtrucks,plate',
        'owner' => 'required|string',
        'food' => 'required',
        'description' => 'string'
    ];

    static $message = [
      'name.required' => 'The foodtruck name is required.',
      'plate.required' => 'The foodtruck vehicle plate is required.',
      'plate.max' => 'The foodtruck vehicle license plate cannot be over 8 characters.',
      'plate.min' => 'The foodtruck vehicle license plate cannot be under 6 characters.',
      'plate.unique' => 'The foodtruck vehicle license plate is already pending.',
      'owner.required' => 'Owner email is required.',
      'food.required' => 'The food type is required.'
    ];

    protected $perPage = 20;
}