<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'date', 'address', 'description'
    ];

    public $timestamps = true;

    static $rules = [
        'name' => 'required|string',
        'owner' => 'required|string',
        'date' => 'required',
        'address' => 'required|string',
        'description' => 'string'
    ];

    static $message = [
      'name.required' => 'The event name is required.',
      'owner.required' => 'Owner email is required.',
      'date.required' => 'The event date is required.',
      'address.required' => 'Address is required.'
    ];

    protected $perPage = 20;
}