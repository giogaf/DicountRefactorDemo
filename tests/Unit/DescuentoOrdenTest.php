<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Descuento;
use App\Models\Orden;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DescuentoOrdenTest extends TestCase
{


    public function nuevaColleccionLibros()
    {
        return collect([
            new Book(['titulo'=>'libro1', 'precio'=>50000]),
            new Book(['titulo'=>'libro2', 'precio'=>100000]),
            new Book(['titulo'=>'libro3', 'precio'=>150000]),
        ]);
    }

    public function setUp()
    {
        $libros=$this->nuevaColleccionLibros();
        $orden = new Orden($libros);
    }

    /**
     * @test
     */
    public function no_plicar_descuento()
    {
        $libros=$this->nuevaColleccionLibros();
        $orden = new Orden($libros);
        $this->assertEquals(300000, $orden->total());
    }

    /**
     * @test
     */
    public function  aplicar_descuento_en_dinero()
    {
        $libros=$this->nuevaColleccionLibros();
        $orden = new Orden($libros);
        $descuento= new Descuento([
            'codigo'=>'OFF10',
            'cantidad'=>10000,
        ]);
        $orden->aplicarDescuento($descuento);
        $this->assertEquals(290000,$orden->total());
    }

    /**
     * @test
     */
    public function aplicar_descuento_en_porcentaje()
    {
        $libros=$this->nuevaColleccionLibros();
        $orden = new Orden($libros);
        $descuento= new Descuento([
            'codigo'=>'OFF10',
            'cantidad'=>10,
            'es_porcentaje'=>true,
        ]);
        $orden->aplicarDescuento($descuento);
        $this->assertEquals(270000,$orden->total());
    }

}
