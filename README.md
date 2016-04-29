# FipeLib
> Biblioteca em PHP para tabela Fipe :moneybag:

## Documentação da API utilizada

[Neste link](http://deividfortuna.github.io/fipe/) é possível encontrar a documentação da API que foi é utilizada por este pacote. Ela também se encontra no branch [gh-pages](https://github.com/deividfortuna/fipe/tree/gh-pages) deste repositório.

## Utilização

Instale o pacote via composer:

```
$ composer require deividfortuna/fipe
```

Utilize-o:

~~~php
<?php

use Fipe\Fipe;

$type = 'carros'; // 'carros', 'motos', 'caminhoes'
$fipe = new Fipe($type);

$fipe->getMarcas();
~~~

O código acima, retornaria algo como:

~~~json
[
  {
    "nome": "Acura",
    "codigo": 1
  },
  {
    "nome": "Agrale",
    "codigo": 2
  }
]
~~~

## API

#### `getMarcas()`
Retorna um Json com a lista de marcas.

#### `getModelos($idMarca)`
Retorna um Json com a lista de modelos de uma determinada marca.

#### `getAnos($idMarca, $idModelo)`
Retorna um Json com a lista de anos de um determinado modelo e de uma determinada marca.

#### `getVeiculo($idMarca, $idModelo, $idAno)`
Retorna um Json com os detalhes do veículo da marca, modelo e ano escolhido.

## Licença

Copyright (c) 2015 [Deivid Fortuna](https://github.com/deividfortuna/fipe/blob/master/LICENSE.md)