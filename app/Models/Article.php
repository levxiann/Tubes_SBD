<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'title',
        'content',
        'credit',
        'writer',
        'image'
    ];
    
    public function category_articles()
    {
        return $this->hasMany(Category_article::class);
    }
}
