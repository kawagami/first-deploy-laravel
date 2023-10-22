<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComponentArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        "component_id",
        "content",
    ];
}
