<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'path_picture',
        'category_id'
    ];
    protected $guarded = [];

    public function category() {
       return $this->belongsTo(Category::class, 'category_id');
    }
    public function comments() {

        return $this->hasMany(Comment::class, 'product_id');

    }

}
