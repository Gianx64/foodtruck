<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'foodtruck_id', 'document_name', 'file', 'expires', 'approved' ];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function foodtruck() {
        return $this->hasOne('App\Models\Foodtruck', 'id', 'foodtruck_id');
    }

    static $message = [
        'document_name.required' => 'The document name is required.',
        'document_name.string' => 'The document name must be a valid name.',
        'document_name.unique' => 'This document name is already pending for this foodtruck.',
        'document_name.exists' => 'This document name does not exist in the database.',
        'file.required' => 'The document file is required.',
        'file.max' => 'The document file is too big.',
        'file.mimes' => 'The document file has to be a pdf file.',
        'foodtruck_id.required' => 'Foodtruck ID is required.',
        'foodtruck_id.integer' => 'Foodtruck ID must be an integer.',
        'expires.required' => 'The expiration date is required.',
        'expires.date' => 'The expiration date must be a date.'
    ];

    protected $table = 'foodtrucks_documents_applications';

    public $timestamps = true;
}