<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishesList extends Model
{
	protected $table = 'wisheslist';

    protected $fillable = [
        'user_id',
        'appliance_id'
    ];


}
