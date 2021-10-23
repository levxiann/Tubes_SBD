<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $fillable = [
        'title',
        'date',
        'author',
        'type',
        'dimension',
        'repository',
        'image'
    ];
    
    public function category_items()
    {
        return $this->hasMany(Category_item::class);
    }
}
