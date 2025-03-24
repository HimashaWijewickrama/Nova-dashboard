<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'website_url',
        'industry',
        'is_published',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
