<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescuentoNulo extends Model
{
    //
    protected $guarded=[];


    public function __construct()
    {
        $this->cantidad = 0;
    }

    public function calcularCantidad($pedido)
    {
        return $this->cantidad;

    }
}
