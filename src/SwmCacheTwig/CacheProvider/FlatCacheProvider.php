<?php

namespace SwmCacheTwig\CacheProvider;

class FlatCacheProvider implements CacheProviderInterface  {

    public $cachePath;
    protected $empreinteSize = 6;

    public function __construct($cachePath)
    {
        $this->cachePath = $cachePath.'/';
    }

    public function setCache($body, $empreinte)
    {
        file_put_contents($this->cachePath.$empreinte.'.tmp', $body);
    }

    public function getCache($empreinte)
    {
        return file_get_contents($this->cachePath.$empreinte.'.tmp');
    }

    /**
     * Check if Cache is present
     *
     * @version  19-01-14
     * @param  String  $empreinte Empreinte of the current block
     * @return boolean            True if already in cache, else false
     */
    public function isCache($empreinte)
    {
        return (bool)file_exists($this->cachePath.$empreinte.'.tmp');
    }

    /**
     * Basic Empreinte return
     *
     * @version  19-01-14
     * @param  String $str Name of the block
     * @param  String $str Indice name
     * @return String      Basic empreinte
     */
    public function getEmpreinte($name, $indice)
    {
        $str = substr(md5($name.$indice), 0, $this->empreinteSize);
        return (string)$str;
    }
}