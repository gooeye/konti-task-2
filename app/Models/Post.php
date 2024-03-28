<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts'; 

    // Primary Key
    protected $primaryKey = 'id'; 

    // Timestamps
    public $timestamps = false;

    // Fillable Fields (for mass assignment)
    protected $fillable = [
        'title',
        'content'
    ];
}