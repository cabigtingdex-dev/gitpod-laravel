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
        'description',
        'publishing_house',
        'publishing_date'
    ];

    protected $dates = [
        'publishing_date'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
