<?php

namespace SwmCacheTwig\CacheProvider;

class TimedFlatCacheProvider implements CacheProviderInterface  {

    public $cachePath;
    public $name;
    public $indice;
    protected $empreinteSize = 6;

    public function __construct($cachePath)
    {
        $this->cachePath = $cachePath.'/swmcache/';
        if(!file_exists($this->cachePath)) mkdir($this->cachePath);
    }

    /**
     * Set content in cache
     *
     * @version  18-02-14
     * @param  String $body      Html content
     * @param  String $empreinte Empreinte of the current block
     */
    public function setCache($body, $empreinte)
    {
        file_put_contents($this->cachePath.$empreinte.'.tmp', $body);
    }

    /**
     * Get cached content
     *
     * @version 18-02-14
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
     * @version  18-02-14
     * @param  String  $empreinte Empreinte of the current block
     * @return boolean            True if already in cache, else false
     */
    public function isCache($empreinte)
    {
        // no file mean no cache
        if(!file_exists($this->cachePath.$empreinte.'.tmp')) return false;

        // filetime+tempo superior to current time
        $fileTime = date("U", filemtime($this->cachePath.$empreinte.'.tmp'));
        if(($fileTime+$this->indice)>time()) return false;

        return true;
    }

    /**
     * Basic Empreinte return
     *
     * @version  18-02-14
     * @param  String $str Name of the block
     * @param  String $str Indice name
     * @return String      Basic empreinte
     */
    public function getEmpreinte($name, $indice)
    {
        $this->name = $name;
        $this->indice = $indice;
        $str = substr(md5($name), 0, $this->empreinteSize);
        return (string)$str;
    }
}