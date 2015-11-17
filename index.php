<?php
require 'src/Fipe/Fipe.php';

use Fipe\Fipe;

$Fipe = new Fipe(Fipe::CARRO);

$marcas = $Fipe->getMarcas();

if($marcas){
    foreach($marcas as $marca){
        echo $marca->nome;
        $modelos = $Fipe->getModelos($marca->codigo);
        if($modelos->modelos){
            foreach($modelos->modelos as $modelo){
                echo $modelo->nome;
                $anos = $Fipe->getAnos($marca->codigo, $modelo->codigo);
                if($anos){
                    foreach($anos as $ano){
                        echo $ano->nome;
                        die;
                    }
                }
            }
        }
    }
}
