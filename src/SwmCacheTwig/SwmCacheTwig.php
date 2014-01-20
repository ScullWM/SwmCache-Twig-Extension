<?php

namespace SwmCacheTwig;

use CacheProvider\FlatCacheProvider;

class SwmCacheTwig extends \Twig_Extension
{
    public function getFlatCache($cachePath)
    {
        return New FlatCacheProvider($cachePath);
    }

    public function getEnv()
    {
        parent::getEnvironment();
    }

    public function getTokenParsers()
    {
        return array(
            new SwmCache(),
        );
    }

    public function getName()
    {
        return 'Swm_Cache_extension';
    }
}