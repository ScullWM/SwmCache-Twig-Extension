<?php

namespace SwmCacheTwig\CacheProvider;

interface CacheProviderInterface
{
    public function setCache($body, $empreinte);

    public function getCache($empreinte);

    public function isCache($empreinte);

    public function getEmpreinte($name, $indice);
}