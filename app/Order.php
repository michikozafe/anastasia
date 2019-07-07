<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function products() {
    	return $this->belongsToMany("\App\Product");
    }

    public function user() {
    	return $this->belongsTo("\App\User");
    }

    public function items() {
        return $this->hasMany("\App\ItemOrder");
    }
}
