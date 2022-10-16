<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShoppingCart extends Model
{
    public $table = "product_shopping_cart";
    use HasFactory;
    protected $fillable = ['shopping_cart_id', 'product_id'];
    
}
