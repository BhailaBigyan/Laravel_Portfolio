<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Template;

class user_github_repos extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'github_username',
        'repo_url',
    ];

   

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
