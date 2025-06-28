<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author',
        'content',
        'repo_url',
        'preview_url',
        'thumbnail',
        'type',
        'download_count',
        'star_count',
        'created_by',
        'updated_at',
    ];

    protected $casts = [
        'download_count' => 'integer',
        'star_count' => 'integer',
        'created_by' => 'integer',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'download_count' => 0,
        'star_count' => 0,
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
