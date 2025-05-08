<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category',
        'image',
        'slug',
        'author',
        'published_at',
    ];
    
}
