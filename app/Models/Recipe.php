<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        // 'views',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_recipes', 'recipe_id', 'category_id');
    }
}
