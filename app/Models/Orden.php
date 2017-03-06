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
        return $this->valorBruto() - $this->valorDescuento();
    }

    /**
     * @param App/Models/Descuento
     */
    public function aplicarDescuento($descuento)
    {
        $this->descuento= $descuento;
    }

    /**
     * @return int
     */
    public function valorDescuento()
    {
        if (isset($this->descuento)) {
            return $this->descuento->calcularCantidad($this->valorBruto());
        }
        return 0;
    }

    /**
     * @return mixed
     */
    public function valorBruto()
    {
        return $this->libros->sum('precio');
    }
}
