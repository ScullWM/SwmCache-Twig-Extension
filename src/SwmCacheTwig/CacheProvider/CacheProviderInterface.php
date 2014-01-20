<?php

namespace SwmCacheTwig\CacheProvider;

interface CacheProviderInterface
{
    public function setCache();

    public function getCache();

    public function isCache();

    public function getEmpreinte();
}