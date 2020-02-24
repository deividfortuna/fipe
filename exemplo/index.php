<?php
require '../vendor/autoload.php';

use DeividFortuna\Fipe\FipeCarros;
use DeividFortuna\Fipe\IFipe;

try {
    $codMarca = filter_input(INPUT_GET, 'codMarca');
    $codModelo = filter_input(INPUT_GET, 'codModelo');
    $codAno = filter_input(INPUT_GET, 'codAno');

    IFipe::setCurlOptions([
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_CONNECTTIMEOUT => 10,
    ]);

    $marcas = FipeCarros::getMarcas();
    if ($codMarca) {
        $modelos = FipeCarros::getModelos($codMarca);
        $modelos = $modelos['modelos'];
        if (!$modelos) {
            throw new Exception('Não foi possível obter os modelos da marca.');
        }

        if ($codModelo) {
            $anos = FipeCarros::getAnos($codMarca, $codModelo);
            if (!$anos) {
                throw new Exception('Não foi possível obter os anos do modelo.');
            }
        }

        if ($codAno) {
            $veiculo = FipeCarros::getVeiculo($codMarca, $codModelo, $codAno);
            if (!$veiculo) {
                throw new Exception('Não foi possível obter os dados do veículo.');
            }
        }
    }
} catch (Exception $e) {
    header('Content-Type: text/html; charset=utf-8');
    die('ERRO: '.$e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Exemplo FipeLib</title>
    <meta charset="utf-8">
</head>
<style>
    * {
        font-family: Verdana;
        font-size: 10px;
    }

    p {
        font-weight: bold;
    }
</style>
<body>
<p>Exemplo de consulta de carros na Fipe<?php if (!$codMarca) {
    echo ', clique em uma marca para iniciar';
} ?>.</p>
<table>
    <tr>
        <td valign="top">
            <strong>Marcas</strong>
            <table>
                <thead>
                <tr>
                    <th align="left">Cód.</th>
                    <th align="left">Nome</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($marcas as $marca) { ?>
                    <tr>
                        <td align="right">
                            <?php echo $marca['codigo'] ?>
                        </td>
                        <td>
                            <a href="?codMarca=<?php echo $marca['codigo'] ?>"><?php echo $marca['nome'] ?></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </td>
        <?php if (isset($modelos)) { ?>
            <td valign="top">
                <strong>Modelos</strong>
                <table>
                    <thead>
                    <tr>
                        <th align="left">Cód.</th>
                        <th align="left">Nome</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($modelos as $modelo) { ?>
                        <tr>
                            <td align="right"><?php echo $modelo['codigo'] ?></td>
                            <td>
                                <a href="<?php echo "?codMarca={$codMarca}&codModelo={$modelo['codigo']}" ?>"><?php echo $modelo['nome'] ?></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </td>
        <?php } ?>
        <?php if (isset($anos)) { ?>
            <td valign="top">
                <strong>Anos</strong>
                <table>
                    <thead>
                    <tr>
                        <th align="left">Cód.</th>
                        <th align="left">Nome</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($anos as $ano) { ?>
                        <tr>
                            <td align="right"><?php echo $ano['codigo'] ?></td>
                            <td>
                                <a href="<?php echo "?codMarca={$codMarca}&codModelo={$codModelo}&codAno={$ano['codigo']}" ?>"><?php echo $ano['nome'] ?></a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </td>
        <?php } ?>
        <?php if (isset($veiculo)) { ?>
            <td valign="top">
                <strong>Veículo</strong>
                <?php echo var_dump($veiculo) ?>
            </td>
        <?php } ?>
    </tr>
</table>
</body>
</html>