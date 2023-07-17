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
    protected $fillable = ['event_id', 'foodtruck_id', 'food', 'approved'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    static $rules = [
        'plate' => 'required|string|min:6|max:8|unique:foodtrucks,plate',
        'foodtruck_name' => 'required|string',
        'food' => 'required|exists:foodtypes,name'
    ];

    static $message = [
        'plate.required' => 'The foodtruck vehicle plate is required.',
        'plate.max' => 'The foodtruck vehicle license plate cannot be over 8 characters.',
        'plate.min' => 'The foodtruck vehicle license plate cannot be under 6 characters.',
        'plate.unique' => 'The foodtruck vehicle license plate is already taken.',
        'foodtruck_name.required' => 'The foodtruck name is required.',
        'foodtruck_id.unique' => 'This foodtruck is already pending.',
        'food.required' => 'The food type is required.',
        'food_id.exists' => 'The food type must be an option from the dropdown menu.',
        'food_id.unique' => 'This food type is already taken.'
    ];

    protected $table = 'foodtrucks_applications';

    public $timestamps = true;
}