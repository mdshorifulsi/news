<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'districtname_bn',
        'districtname_en',
        'districtslug_bn',
        'districtslug_en',


    ];

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }

    public function subdistrict()
    {
        return $this->hasMany('App\Models\Subdistrict');
    }
}