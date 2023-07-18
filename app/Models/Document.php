<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['foodtruck_id','document_name','file','expires'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function foodtruck()
    {
        return $this->hasOne('App\Models\Foodtruck', 'id', 'foodtruck_id');
    }

    static $rules = [
        'foodtruck_id' => 'required|integer',
        'document_name' => 'required|string',
        'file' => 'required|unique:foodtrucks_documents_applications,file',
        'expires' => 'required|date'
    ];

    static $message = [
      'foodtruck_id.required' => 'The event name is required.',
      'owner.required' => 'Owner email is required.',
      'date.required' => 'The event date is required.',
      'address.required' => 'Address is required.',
      'slots.required' => 'The event slots is required.',
      'slots.integer' => 'The event slots must be a positive integer.',
      'slots.min' => 'The event slots must be at least 1.',
      'slots.max' => 'The event slots is too big.',
      'map.required' => 'The event map is required.',
      'map.max' => 'The event map is too big.',
      'map.mimes' => 'The map has to be a jpeg,png,jpg,gif or svg image.'
    ];

    protected $table = 'foodtrucks_documents_applications';

    public $timestamps = true;
}
