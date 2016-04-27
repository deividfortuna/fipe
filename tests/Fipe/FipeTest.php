<?php

namespace Fipe\Tests;

use Fipe\Fipe;
use PHPUnit_Framework_TestCase as PHPUnit;

class FipeTest extends PHPUnit
{
    public function testTypeHandler()
    {
        $fipe = new Fipe('carros');
        $this->assertEquals('carros', $fipe->getType());
        $fipe->setType('motos');
        $this->assertEquals('motos', $fipe->getType());
    }

    public function testGetBrands()
    {
        $fipe = new Fipe('motos');
        $brands = $fipe->getMarcas();

        $this->assertInternalType('array', $brands);
        $this->assertNotEquals(0, count($brands));
    }

    public function testGetModels()
    {
        $fipe = new Fipe('motos');
        $models = $fipe->getModelos(80);

        $this->assertInternalType('object', $models);
    }

    public function testGetYears()
    {
        $fipe = new Fipe('motos');
        $years = $fipe->getAnos(80, 3841);

        $this->assertInternalType('array', $years);
        $this->assertNotEquals(0, count($years));
    }

    public function testGetVehicle()
    {
        $fipe = new Fipe('motos');
        $vehice = $fipe->getVeiculo(80, 3841, '2015-1');

        $this->assertInternalType('object', $vehice);
    }
}
