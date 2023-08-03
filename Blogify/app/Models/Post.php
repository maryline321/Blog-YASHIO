<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'tag_id'];

    protected $with = ["tags"];
    public function tags()
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }
}
