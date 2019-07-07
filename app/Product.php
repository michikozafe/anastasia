<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function category() {
    	return $this->belongsTo("\App\Category");
    }

    public function sizes() {
    	return $this->belongsToMany('\App\Size', 'product_sizes')->withPivot('quantity')->withTimeStamps();
    }

    public function order() {
    	return $this->belongsTo("\App\Order");
    }

    public function status() {
    	return $this->belongsTo("\App\Status");
    }

    public function favorite() {
    	return $this->belongsTo("\App\Favorite");
    }


}
