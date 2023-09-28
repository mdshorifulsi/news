<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tagname_bn',
        'tagname_en',
        'tagslug_bn',
        'tagslug_en',
    ];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_tag')->withTimestamps();
    }


}