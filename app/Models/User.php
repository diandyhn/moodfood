<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'current_mood',
        'dietary_preferences',
        'budget_range'
    ];

    protected $casts = [
        'dietary_preferences' => 'array'
    ];

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
