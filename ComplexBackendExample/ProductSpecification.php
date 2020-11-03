<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecification extends Model
{
    protected $fillable = [
        'specification_id', 'value', 'unit', 'product_id'
    ];

    public function specification()
    {
        return $this->belongsTo('App\Specification');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
