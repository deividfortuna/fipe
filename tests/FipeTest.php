<?php

namespace DeividFortuna\Fipe\Tests;

use DeividFortuna\Fipe\Caminhoes;
use DeividFortuna\Fipe\Carros;
use DeividFortuna\Fipe\Motos;
use PHPUnit_Framework_TestCase as PHPUnit;

class FipeTest extends PHPUnit
{
    public function testGetMarcas()
    {
        $marcasDeCaminhoes = (new Caminhoes())->getMarcas();
        $marcasDeCarros    = (new Carros())->getMarcas();
        $marcasDeMotos     = (new Motos())->getMarcas();

        $this->assertEquals(true, is_array($marcasDeCaminhoes));
        $this->assertEquals(true, is_array($marcasDeCarros));
        $this->assertEquals(true, is_array($marcasDeMotos));
    }

    public function testGetModelos()
    {
        $motos   = new Motos();
        $modelos = $motos->getModelos(80);

        $this->assertInternalType('object', $modelos);
    }

    public function testGetAnos()
    {
        $motos = new Motos();
        $anos  = $motos->getAnos(80, 3841);

        $this->assertInternalType('array', $anos);
        $this->assertNotEquals(0, count($anos));
    }

    public function testGetVeiculo()
    {
        $motos   = new Motos();
        $veiculo = $motos->getVeiculo(80, 3841, '2015-1');

        $this->assertInternalType('object', $veiculo);
    }
}
