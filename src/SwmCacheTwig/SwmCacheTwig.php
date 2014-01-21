<?php

namespace SwmCacheTwig;

use SwmCacheTwig\CacheProvider\FlatCacheProvider;
use SwmCacheTwig\TokenParser\SwmCacheTokenParser;

class SwmCacheTwig extends \Twig_Extension
{
    /**
     * Provide flat Cache Service
     *
     * @version  21-01-14
     * @param  String $cachePath Cache Path set on Twig
     * @return FlatCacheProvider            Get all services
     */
    public function getFlatCache($cachePath)
    {
        return New FlatCacheProvider($cachePath);
    }

    /**
     * Return token Parser
     * 
     * @version  21-01-14
     * @return array    Return the main SwmCacheTokenParser
     */
    public function getTokenParsers()
    {
        return array(
            new SwmCacheTokenParser(),
        );
    }

    /**
     * Say my name bitch!
     * 
     * @version  21-01-14
     * @return String   Extension name
     */
    public function getName()
    {
        return 'Swm_Cache_extension';
    }
}