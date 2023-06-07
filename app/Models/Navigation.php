<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nav_bn',
        'nav_en',
        'slug',
        'position',
        'status',
    ];

    public function category(): HasMany
    {
        return $this->hasMany(Category::class, 'nav_id', 'id')->where('status', 1)->select(['id', 'category_bn', 'nav_id', 'slug']);
    }
}
