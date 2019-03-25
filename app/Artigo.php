<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artigo extends Model
{
    protected $table = 'artigos';
    
    protected $fillable = [
        'title', 'link', 'user_id',
    ];
}
