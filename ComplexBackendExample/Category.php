<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'slug', 'level', 'category_id'
    ];

    public $hidden = [
        'created_at', 'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
    
}
