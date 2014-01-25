<?php

namespace SwmCacheTwig\CacheProvider;

class FlatCacheProvider implements CacheProviderInterface  {

    public $cachePath;
    public $name;
    public $indice;
    protected $empreinteSize = 6;

    public function __construct($cachePath)
    {
        $this->cachePath = $cachePath.'/swmcache/';
    }

    /**
     * Set content in cache
     *
     * @version  19-01-14
     * @param  String $body      Html content
     * @param  String $empreinte Empreinte of the current block
     */
    public function setCache($body, $empreinte)
    {
        if(!file_exists($this->cachePath)) mkdir($this->cachePath);
        file_put_contents($this->cachePath.$empreinte.'.tmp', $body);
    }

    /**
     * Get cached content
     *
     * @version 19-01-14
     * @param  String $empreinte Empreinte of the current block
     * @return String            Html content
     */
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
        $this->name = $name;
        $this->indice = $indice;
        $str = substr(md5($name.$indice), 0, $this->empreinteSize);
        return (string)$str;
    }
}