<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
	 protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'price',
        'application_id',
        'external_id'
    ];

    // $guarded
    //
}
