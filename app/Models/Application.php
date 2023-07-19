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
    protected $fillable = ['event_id', 'foodtruck_id', 'food', 'approved'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function event() {
        return $this->hasOne('App\Models\Event', 'id', 'event_id');
    }

    static $message = [
        'foodtruck_name.required' => 'The foodtruck name is required.',
        'foodtruck_id.integer' => 'Foodtruck ID must be an integer.',
        'foodtruck_id.unique' => 'This foodtruck is already pending.',
        'food.required' => 'The food type is required.',
        'food.exists' => 'The food type must be an option from the dropdown menu.',
        'food.unique' => 'This food type is already taken.'
    ];

    protected $table = 'foodtrucks_applications';

    public $timestamps = true;
}