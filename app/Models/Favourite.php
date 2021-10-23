<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $table = 'favourites';

    protected $fillable = [
        'user_id',
        'fav_id',
        'medium_id',
        'item_id',
        'article_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medium()
    {
        return $this->belongsTo(Medium::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
