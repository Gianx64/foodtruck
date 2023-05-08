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
    protected $fillable = ['name','owner','date','address','description','map'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'email', 'owner');
    }

    static $rules = [
        'name' => 'required|string|unique:events,name',
        'owner' => 'required|string',
        'date' => 'required',
        'address' => 'required|string',
        'map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ];

    static $message = [
      'name.required' => 'The event name is required.',
      'owner.required' => 'Owner email is required.',
      'date.required' => 'The event date is required.',
      'address.required' => 'Address is required.',
      'map.required' => 'The event map is required.',
      'map.max' => 'The event map is too big.',
      'map.mimes' => 'The map has to be a jpeg,png,jpg,gif or svg image.'
    ];

    protected $table = 'events';

    public $timestamps = true;
}
