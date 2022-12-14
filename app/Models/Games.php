<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'desc',
        'content',
        'cover',
        'price',
        'sale',
        'category_id',
        'xbox_one',
        'xbox_sx'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
