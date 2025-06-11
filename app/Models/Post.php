<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Fields that can be mass-assigned
    protected $fillable = ['body', 'user_id'];

    // Relationship: each post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function posts()
    {  
        return $this->hasMany(Post::class);
    }

}
