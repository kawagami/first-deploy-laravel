<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'destination',
        'short_url',
        'remark',
    ];

    /**
     * onwer
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
