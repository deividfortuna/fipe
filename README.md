# FipeLib
 Biblioteca em PHP para consultar a tabela Fipe :moneybag:
API de Consulta Tabela FIPE fornece preços médios de veículos no mercado nacional através de um serviço RESTful HTTP Json. Atualizada mensalmente com dados extraidos da tabela FIPE

>[!IMPORTANT] 
> Após quase 10 anos de manutenção, atualizações e fornecimento totalmente gratuito e ilimitado, tive que tomar a decisão de colocar um limite de uso na API.
> A partir de agora, a API será limitada a **500 requisições gratuitas e não autenticadas** por dia (24h). Se você criar um token de acesso [aqui](https://fipe.online/register), poderá fazer até **1000 requisições** por dia (24h).
>
> Caso você precise de **requisições ilimitadas** e acesso a 1 ano de histórico de preços, considere contratar um plano de suporte através do site [fipe.online](https://fipe.online/pricing).


## API Status
[![Uptime Robot status](https://img.shields.io/uptimerobot/status/m792332790-ff28744d182f8df575324136?style=for-the-badge&label=Fipe%20API)](http://parallelum.com.br/fipe/status) [![Uptime Robot status](https://img.shields.io/uptimerobot/status/m792381741-24bdd8f165658ec9e85edea8?style=for-the-badge&label=Fipe.org%20(Official%20Website))](http://parallelum.com.br/fipe/status)


## API utilizada
A documentação da API utilizada pela biblioteca para obter os dados da Fipe está disponível [neste link](http://deividfortuna.github.io/fipe/v2/) e também pode ser encontrada no branch [gh-pages](https://github.com/deividfortuna/fipe/tree/gh-pages) deste repositório.

## Classes e métodos
A biblioteca possui 3 classes para consultar a tabela Fipe, uma para cada tipo de veículo, são elas:
* `FipeCaminhoes` consulta a tabela de caminhões
* `FipeCarros` consulta a tabela de carros
* `FipeMotos` consulta a tabela de motos

Cada classe possui os seguintes métodos:
* `getMarcas()` retorna um array com os códigos e nomes das marcas do tipo de veículo escolhido
* `getModelos($codMarca)` retorna um array com o códigos e nomes dos modelos da marca informada
* `getAnos($codMarca, $codModelo)` retorna um array com os códigos e nomes dos anos de um modelo de veículo
* `getVeiculo($codMarca, $codModelo, $codAno)` retorna um array com os dados da tabela Fipe do veículo especificado

## Exemplos de uso
Veja um exemplo de como consultar as marcas de carros:
~~~php
<?php
use DeividFortuna\Fipe\FipeCarros;

$marcas = FipeCarros::getMarcas();

var_dump($marcas);
~~~

Utilizando o token de acesso para aumentar o limite de requisições:
~~~php
<?php
use DeividFortuna\Fipe\FipeCarros;

$token = 'SEU_TOKEN';
IFipe::setCurlOptions([
    CURLOPT_HTTPHEADER => ["X-Subscription-Token:$token"]
]);

$marcas = FipeCarros::getMarcas();

var_dump($marcas);
~~~

O código acima irá retornar um array:
~~~php
[
  [
    "nome": "Acura",
    "codigo": 1
  ], [
    "nome": "Agrale",
    "codigo": 2
  ],
  // etc...
]
~~~

Um exemplo funcional pode ser encontrado na pasta `exemplo` deste projeto.

## Licença

Copyright (c) 2016 [Deivid Fortuna](https://github.com/deividfortuna/fipe/blob/master/LICENSE.md)
