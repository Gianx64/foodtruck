<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model {
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'event_id', 'foodtruck_id', 'food', 'approved' ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event() {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    static $message = [
        'foodtruck_name.required' => 'The foodtruck name is required.',
        'foodtruck_id.integer' => 'Foodtruck ID must be an integer.',
        'foodtruck_id.unique' => 'This foodtruck has already applied to this event.',
        'foods.required' => 'The food types are required.',
        'foods.array' => 'The food types must be an array.',
        'foods.min' => 'There must be at least 1 food type.',
        'foods.max' => 'The maximum of food types is 3.',
        'foods.*.required' => 'The food types are required.',
        'foods.*.exists' => 'The food type must be an option from the dropdown menu.',
        'foods.*.unique' => 'This food type is already taken for this event.'
    ];

    protected $table = 'foodtrucks_applications';

    public $timestamps = true;
}