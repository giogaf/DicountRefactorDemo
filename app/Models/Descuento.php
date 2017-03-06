<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descuento extends Model
{
    //
    protected $guarded=[];


    public function calcularCantidad($valorTotal)
    {
        if ($this->es_porcentaje)
        {
            return $valorTotal * $this->cantidad/100;
        }
        return $this->cantidad;

    }
}
