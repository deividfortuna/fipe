<?php

namespace DeividFortuna\Fipe;

abstract class IFipe
{
    const URL = 'https://fipe-parallelum.rhcloud.com/api/v1/';

    /**
     * @var string
     */
    protected static $tipo;

    /**
     * @param string $uri
     * @return mixed|false
     */
    protected static function request($uri)
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

    public static function getMarcas()
    {
        $uri = self::URL.static::$tipo.'/marcas';
        return self::request($uri);
    }

    public static function getModelos($idMarca)
    {
        $uri = self::URL.static::$tipo.'/marcas/'.$idMarca.'/modelos';
        return static::request($uri);
    }

    public static function getAnos($idMarca, $idModelo)
    {
        $uri = self::URL.static::$tipo.'/marcas/'.$idMarca.'/modelos/'.$idModelo.'/anos';
        return static::request($uri);
    }

    public static function getVeiculo($idMarca, $idModelo, $idAno)
    {
        $uri = self::URL.static::$tipo.'/marcas/'.$idMarca.'/modelos/'.$idModelo.'/anos/'.$idAno;
        return static::request($uri);
    }
}
