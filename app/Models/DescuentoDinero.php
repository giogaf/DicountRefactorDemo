<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescuentoDinero extends Model
{
    //
    protected $guarded=[];


    public function calcularCantidad($pedido)
    {
            return $this->cantidad;
    }
}
