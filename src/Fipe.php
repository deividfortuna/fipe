<?php

namespace Fipe;

class Fipe
{
    private $tipo;
    private $uri = 'https://fipe-parallelum.rhcloud.com/api/v1/';
    private $supportedTypes = [
        'carros',
        'caminhaos',
        'motos',
    ];

    public function __construct($tipo)
    {
        if (!in_array($tipo, $this->supportedTypes)) {
            throw new \Exception('Select a valid type on construct');
        }

        $this->setTipo($tipo);
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * Method to make some requests
     *
     * @param  $uri
     * @return bool|mixed
     */
    private function request($uri)
    {
        try {
            $curlOptions = [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 1,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_SSL_VERIFYPEER => 0,
            ];

            $ch = curl_init($uri);
            curl_setopt_array($ch, $curlOptions);
            $html = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            return ($httpCode >= 200 && $httpCode < 300) ? json_decode($html) : false;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getMarcas()
    {
        $uri = $this->uri . $this->tipo . '/marcas';
        return $this->request($uri);
    }

    public function getModelos($idMarca)
    {
        $uri = $this->uri . $this->tipo . '/marcas/' . $idMarca . '/modelos';
        return $this->request($uri);
    }

    public function getAnos($idMarca, $idModelo)
    {
        $uri = $this->uri . $this->tipo . '/marcas/' . $idMarca . '/modelos/' . $idModelo . '/anos';
        return $this->request($uri);
    }

    public function getVeiculo($idMarca, $idModelo, $idAno)
    {
        $uri = $this->uri . $this->tipo . '/marcas/' . $idMarca . '/modelos/' . $idModelo . '/anos/' . $idAno;
        return $this->request($uri);
    }
}
