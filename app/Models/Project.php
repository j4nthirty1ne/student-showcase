<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'url',
        'github_link',
        'cover_image',
        'technologies',
        'images',
        'status',
    ];

    protected $casts = [
        'technologies' => 'array',
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function projectImages()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
