<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nft extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'name',
        'image',
        'json'
    ];

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getSubCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
