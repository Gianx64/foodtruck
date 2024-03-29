<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foodtruck extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'user_id', 'plate', 'foodtruck_name', 'food' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event() {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    static $rules = [
        'plate' => 'required|string|min:6|max:8|unique:foodtrucks,plate',
        'foodtruck_name' => 'required|string',
        'foods' => 'required|array|min:1|max:3',
        'foods.*' => 'required|exists:foodtypes,name'
    ];

    static $message = [
        'plate.required' => 'The foodtruck vehicle plate is required.',
        'plate.min' => 'The foodtruck vehicle license plate cannot be under 6 characters.',
        'plate.max' => 'The foodtruck vehicle license plate cannot be over 8 characters.',
        'plate.unique' => 'The foodtruck vehicle license plate is already taken.',
        'foodtruck_name.required' => 'The foodtruck name is required.',
        'foods.required' => 'The food types are required.',
        'foods.array' => 'The food types must be an array.',
        'foods.min' => 'There must be at least 1 food type.',
        'foods.max' => 'The maximum of food types is 3.',
        'foods.*.required' => 'The food types are required.',
        'foods.*.exists' => 'The food type must be an option from the dropdown menu.'
    ];

    protected $table = 'foodtrucks';

    public $timestamps = true;
}