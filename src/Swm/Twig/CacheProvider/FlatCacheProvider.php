<?php

namespace CacheProvider;

class FlatCacheProvider implements CacheProviderInterface {

    public $cachePath;

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

    public function isCache($empreinte)
    {
        return (bool)file_exists($this->cachePath.$empreinte.'.tmp');
    }

    public function getEmpreinte($str)
    {
        return md5($str);
    }
}