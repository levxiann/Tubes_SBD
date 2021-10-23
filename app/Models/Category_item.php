<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_item extends Model
{
    use HasFactory;

    protected $table = 'category_items';

    protected $fillable = [
        'item_id',
        'medium_id',
    ];
    
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function medium()
    {
        return $this->belongsTo(Medium::class);
    }
}
