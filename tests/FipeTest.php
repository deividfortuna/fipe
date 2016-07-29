<?php

namespace DeividFortuna\Fipe\Tests;

use DeividFortuna\Fipe\FipeCaminhoes;
use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\FipeMotos;
use PHPUnit_Framework_TestCase as PHPUnit;

class FipeTest extends PHPUnit
{
    public function testGetMarcas()
    {
        $marcasDeCaminhoes = FipeCaminhoes::getMarcas();
        $marcasDeCarros    = FipeCarros::getMarcas();
        $marcasDeMotos     = FipeMotos::getMarcas();
        $this->assertEquals(true, is_array($marcasDeCaminhoes));
        $this->assertEquals(true, is_array($marcasDeCarros));
        $this->assertEquals(true, is_array($marcasDeMotos));
    }

    public function testGetModelos()
    {
        $modelos = FipeMotos::getModelos(80);
        $this->assertInternalType('object', $modelos);
    }

    public function testGetAnos()
    {
        $anos = FipeMotos::getAnos(80, 3841);
        $this->assertInternalType('array', $anos);
        $this->assertNotEquals(0, count($anos));
    }

    public function testGetAnosInvalido()
    {
        $anos = FipeMotos::getAnos(0, 0);
        $this->assertEquals(false, $anos);
    }

    public function testGetVeiculo()
    {
        $veiculo = FipeMotos::getVeiculo(80, 3841, '2015-1');
        $this->assertInternalType('object', $veiculo);
    }

    public function testGetVeiculoInvalido()
    {
        $veiculo = FipeMotos::getVeiculo(0, 0, 0);
        $this->assertEquals(false, $veiculo);
    }
}
