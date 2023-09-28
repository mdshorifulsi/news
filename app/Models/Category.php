<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'catname_bn',
        'catname_en',
        'catslug_bn',
        'catslug_en',
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'category_post')->withTimestamps();
    }





}