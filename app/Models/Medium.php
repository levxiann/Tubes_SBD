<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medium extends Model
{
    use HasFactory;

    protected $table = 'mediums';
    
    public function category_items()
    {
        return $this->hasMany(Category_item::class);
    }

    public function category_articles()
    {
        return $this->hasMany(Category_article::class);
    }
}
