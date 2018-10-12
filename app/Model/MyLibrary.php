<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MyLibrary extends Model
{
    protected $fillable = ['user_id', 'image_type', 'image'];
}
