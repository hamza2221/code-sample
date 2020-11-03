<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $fillable = [
        'person_name', 'name', 'address1', 'address2', 'address3', 'n_t_n_number', 'g_s_t_number', 'remarks',
        'product_id', 'purchase_amount', 'landline_number', 'srs_code',
        'subscription_type', 'courier', 'status', 'postal_name', 'postal_address1', 'postal_address2', 'postal_address3',
        'nick_name', 'nick_address1', 'nick_address2', 'nick_address3', 'country_id',
    ];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function licenses()
    {
        return $this->hasMany('App\License');
    }

    public function licenseMonths()
    {
        return $this->hasMany('App\LicenseMonth');
    }

    public function people()
    {
        return $this->hasMany('App\Person');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }
}
