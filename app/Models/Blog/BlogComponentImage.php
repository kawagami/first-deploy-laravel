<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComponentImage extends Model
{
    use HasFactory;

    protected $fillable = [
        "component_id",
        "image_id",
        "name",
        "url",
        "original_name",
        "status",
    ];
}
