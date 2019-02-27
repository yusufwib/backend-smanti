<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class posting extends Model
{
    protected $fillable = ['id','title', 'featuredImage','featuredText','text','typeText'];
}
