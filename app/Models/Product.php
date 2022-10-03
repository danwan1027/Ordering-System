<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const TYPE_SINGLE = 'single';
    const TYPE_COMBO = 'combo';

    protected $fillable = [
        'name',
        'description',
        'image',
        'type',
        'count',
        'price',
    ];

}
