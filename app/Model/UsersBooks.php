<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UsersBooks extends Model
{
    protected $table = 'users_books';
    
    protected $fillable = ['user_id', 'book_id', 'front_cover', 'inside_front_cover', 'inside_back_cover', 'back_cover'];
}
