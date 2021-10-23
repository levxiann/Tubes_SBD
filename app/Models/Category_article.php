<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_article extends Model
{
    use HasFactory;

    protected $table = 'category_articles';

    protected $fillable = [
        'article_id',
        'medium_id',
    ];
    
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function medium()
    {
        return $this->belongsTo(Medium::class);
    }
}
