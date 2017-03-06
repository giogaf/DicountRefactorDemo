<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    //
    /**
     * @var collect
     */
    protected $libros;
    /**
     * @var int
     */
    protected $descuento;

    public function __construct($libros)
    {
        $this->libros=$libros;
    }

    /**
     * @return int
     */
    public function total()
    {
        if (isset($this->descuento))
        {
            $valorDescuento= $this->descuento->cantidad;
        }else{
            $valorDescuento=0;
        }
        return $this->libros->sum('precio')-$valorDescuento;
    }

    /**
     * @param App/Models/Descuento
     */
    public function aplicarDescuento($descuento)
    {
        $this->descuento= $descuento;
    }
}
