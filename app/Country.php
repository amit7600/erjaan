<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Country extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'countries';
    
    protected $fillable = ['sortname', 'name', 'dial_code'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'current_activity' => 'string',
    ];
    
    public function setFirstNameAttribute($value)
    {if(empty($value)){$this->attributes['first_name'] = '';}}
    public function setLastNameAttribute($value)
    {if(empty($value)){$this->attributes['last_name'] = '';}}
    public function setCustomerEmailAttribute($value)
    {if(empty($value)){$this->attributes['customer_email'] = '';}}
    public function setDrivingLicenseAttribute($value)
    {if(empty($value)){$this->attributes['driving_license'] = '';}}
    public function setCustomerPhoneAttribute($value)
    {if(empty($value)){$this->attributes['customer_phone'] = '';}}
    public function setCustomerMobileAttribute($value)
    {if(empty($value)){$this->attributes['customer_mobile'] = '';}}
    public function setCustomerAddressAttribute($value)
    {if(empty($value)){$this->attributes['customer_address'] = '';}}
    public function setCustomerPostcodeAttribute($value)
    {if(empty($value)){$this->attributes['customer_postcode'] = '';}}
    public function setCustomerCityAttribute($value)
    {if(empty($value)){$this->attributes['customer_city'] = '';}}
    public function setCustomerStateAttribute($value)
    {if(empty($value)){$this->attributes['customer_state'] = '';}}
    public function setCustomerCountryAttribute($value)
    {if(empty($value)){$this->attributes['customer_country'] = '';}}
    public function setOrganizationAttribute($value)
    {if(empty($value)){$this->attributes['organization'] = '';}}
    public function setStatusAttribute($value)
    {if(empty($value)){$this->attributes['status'] = '';}}
    
}
