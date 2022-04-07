<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'description',
        'publishing_house',
        'publishing_date'
    ];

    protected $dates = [
        'publishing_date'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
