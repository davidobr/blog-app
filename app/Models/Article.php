<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public $article_title = 'article_title';
    public $article_description = 'article_description';
    public $created_by = 'created_by';
    public $timestamps = false;
    
}
