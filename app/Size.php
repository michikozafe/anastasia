<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    public function products() {
    	//create a link with the items table
    	return $this->belongsToMany("\App\Product", "product_sizes")->withPivot("quantity")->withTimeStamps();
    }
}
