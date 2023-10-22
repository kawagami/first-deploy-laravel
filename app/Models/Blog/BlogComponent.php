<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComponent extends Model
{
    use HasFactory;

    protected $fillable = [
        "blog_id",
        "type",
    ];

    /**
     */
    public function image()
    {
        return $this->hasOne(BlogComponentImage::class, 'component_id', 'id');
    }

    /**
     */
    public function article()
    {
        return $this->hasOne(BlogComponentArticle::class, 'component_id', 'id');
    }
}
