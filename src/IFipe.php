<?php

namespace DeividFortuna\Fipe;

abstract class IFipe
{
    const URI = 'https://fipe-parallelum.rhcloud.com/api/v1/';

    /**
     * @var string
     */
    protected $tipo;

    /**
     * @param string $uri
     * @return mixed|false
     */
    protected function request($uri)
    {
        $curlOptions = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_TIMEOUT        => 5,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_SSL_VERIFYPEER => 0
        ];

        $ch = curl_init($uri);
        curl_setopt_array($ch, $curlOptions);
        $html     = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return ($httpCode >= 200 && $httpCode < 300) ? json_decode($html) : false;
    }

    public function getMarcas()
    {
        $uri = self::URI.$this->tipo.'/marcas';
        return $this->request($uri);
    }

    public function getModelos($idMarca)
    {
        $uri = self::URI.$this->tipo.'/marcas/'.$idMarca.'/modelos';
        return $this->request($uri);
    }

    public function getAnos($idMarca, $idModelo)
    {
        $uri = self::URI.$this->tipo.'/marcas/'.$idMarca.'/modelos/'.$idModelo.'/anos';
        return $this->request($uri);
    }

    public function getVeiculo($idMarca, $idModelo, $idAno)
    {
        $uri = self::URI.$this->tipo.'/marcas/'.$idMarca.'/modelos/'.$idModelo.'/anos/'.$idAno;
        return $this->request($uri);
    }
}
