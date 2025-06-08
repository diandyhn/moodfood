<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'calories',
        'price',
        'category',
        'mood_tags',
        'ingredients',
        'gofood_link',
        'image_url',
        'is_healthy',
        'spicy_level',
        'preparation_time'
    ];

    protected $casts = [
        'mood_tags' => 'array',
        'ingredients' => 'array',
        'is_healthy' => 'boolean',
        'price' => 'decimal:2'
    ];
}
