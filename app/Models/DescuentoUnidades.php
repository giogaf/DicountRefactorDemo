<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescuentoUnidades extends Model
{
    //
    protected $guarded=[];


    public function calcularCantidad($pedido)
    {
        if ($pedido->cantidad() > $this->unidades)
        {
            return $pedido->valorBruto() * $this->cantidad/100;
        }
        return 0;

    }
}
