<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['marca', 'razon_social', 'direccion', 'representante', 'email'];
}
