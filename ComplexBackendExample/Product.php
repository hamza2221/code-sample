<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'model_number', 'name', 'slug', 'stock_keeping_unit',
        'state', 'description', 'product_page', 'price', 'discounted_price',
        'currency_id', 'brand_id', 'length', 'width', 'height', 'weight',
        'quantity'
    ];

    public $hidden = [
        'created_at', 'updated_at'
    ];

    protected $with = ['featuredProductMedia', 'currency', 'category'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function cartItems()
    {
        return $this->hasMany('App\CartItem');
    }

    public function customerReviews()
    {
        return $this->hasMany('App\CustomerReview');
    }

    public function orderItems()
    {
        return $this->hasMany('App\OrderItem');
    }

    public function productAttributes()
    {
        return $this->hasMany('App\ProductAttribute');
    }

    public function productMedias()
    {
        return $this->hasMany('App\ProductMedia');
    }

    public function featuredProductMedia()
    {
        return $this->hasOne('App\ProductMedia');
    }

    public function productSpecifications()
    {
        return $this->hasMany('App\ProductSpecification');
    }

    public function productVariations()
    {
        return $this->hasMany('App\ProductVariation');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function questionAnswers()
    {
        return $this->hasMany('App\Question')->where('answer', '<>', 'NULL');
    }

    public function wishItems()
    {
        return $this->hasMany('App\WishItem');
    }
}
