<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescuentoPorcentaje extends Model
{
    //
    protected $guarded=[];


    public function calcularCantidad($pedido)
    {
            return $pedido->valorBruto() * $this->cantidad/100;
    }
}
