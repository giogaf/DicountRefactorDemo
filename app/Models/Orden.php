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
        return $this->libros->sum('precio') - $this->descuento();
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
    public function descuento()
    {
        if (isset($this->descuento)) {
            if ($this->descuento->es_porcentaje)
            {
                $valorDescuento = $this->libros->sum('precio') * $this->descuento->cantidad/100;
            }else{
                $valorDescuento = $this->descuento->cantidad;
            }
            return $valorDescuento;
        } else {
            return 0;
        }
    }
}
