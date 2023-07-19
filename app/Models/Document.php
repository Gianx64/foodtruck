<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['foodtruck_id', 'document_name', 'file', 'expires', 'approved'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function foodtruck() {
        return $this->hasOne('App\Models\Foodtruck', 'id', 'foodtruck_id');
    }

    static $rules = [
        'foodtruck_id' => 'required|integer',
        'document_name' => 'required|string|unique:foodtrucks_documents_applications,document_name',
        'expires' => 'required|date',
        'file' => 'required|mimes:pdf'
    ];

    static $message = [
        'foodtruck_id.required' => 'Foodtruck ID is required.',
        'foodtruck_id.integer' => 'Foodtruck ID must be an integer.',
        'document_name.required' => 'The document name is required.',
        'document_name.string' => 'The document name must be a valid name.',
        'document_name.unique' => 'This document name is already pending for this foodtruck.',
        'expires.required' => 'The expiration date is required.',
        'expires.date' => 'The expiration date must be a date.',
        'file.required' => 'The document file is required.',
        'file.max' => 'The document file is too big.',
        'file.mimes' => 'The document file has to be a pdf file.'
    ];

    protected $table = 'foodtrucks_documents_applications';

    public $timestamps = true;
}
