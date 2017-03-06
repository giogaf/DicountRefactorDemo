<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\DescuentoDinero;
use App\Models\DescuentoNulo;
use App\Models\DescuentoPorcentaje;
use App\Models\DescuentoUnidades;
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
        $orden->aplicarDescuento(new DescuentoNulo());
        $this->assertEquals(300000, $orden->total());
    }

    /**
     * @test
     */
    public function  aplicar_descuento_en_dinero()
    {
        $libros=$this->nuevaColleccionLibros();
        $orden = new Orden($libros);
        $descuento= new DescuentoDinero([
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
        $descuento= new DescuentoPorcentaje([
            'codigo'=>'OFF10',
            'cantidad'=>10,
        ]);
        $orden->aplicarDescuento($descuento);
        $this->assertEquals(270000,$orden->total());
    }

    /**
     * @test
     */
    public function aplicar_descuento_unidades()
    {
        $libros=$this->nuevaColleccionLibros();
        $orden = new Orden($libros);
        $descuento= new DescuentoUnidades([
            'codigo'=>'OFF10',
            'cantidad'=>10,
            'unidades'=>2,  //unidades mínimas
        ]);
        $orden->aplicarDescuento($descuento);
        $this->assertEquals(270000,$orden->total());
    }

    /**
     * @test
     */
    public function no_aplicar_descuento_unidades()
    {
        $libros=$this->nuevaColleccionLibros();
        $orden = new Orden($libros);
        $descuento= new DescuentoUnidades([
            'codigo'=>'OFF10',
            'cantidad'=>10,
            'unidades'=>5,  //unidades mínimas
        ]);
        $orden->aplicarDescuento($descuento);
        $this->assertEquals(300000,$orden->total());
    }
}
