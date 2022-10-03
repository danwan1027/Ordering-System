<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATE_MAKING = 'making';
    const STATE_RECEIVING = 'receiving';
    const STATE_DONE = 'done';
    const STATE_CART = 'cart';

    protected $fillable = [
        'name',
        'description',
        'state',
        'customer',
        'updated_at',
        'created_at',
        'price',
        ];

}
