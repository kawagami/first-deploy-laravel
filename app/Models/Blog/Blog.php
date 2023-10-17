<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name",
        "short_content",
    ];

    /**
     */
    public function components()
    {
        return $this->hasMany(BlogComponent::class);
    }
}
