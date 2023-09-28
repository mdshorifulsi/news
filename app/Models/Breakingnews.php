<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breakingnews extends Model
{
    use HasFactory;

     protected $fillable = [
        'breakingnews_bn',
        'breakingnews_en',
    ];
}
