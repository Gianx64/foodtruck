<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foodtype extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function foodtruck()
    {
        return $this->hasOne('App\Models\Foodtruck', 'food', 'name');
    }

    static $rules = [
        'name' => 'required|string|unique:foodtypes,name'
    ];

    static $message = [
      'name.required' => 'The foodtype name is required.',
      'name.unique' => 'The foodtype name has to be unique.'
    ];

    protected $table = 'foodtypes';

    public $timestamps = true;
}
