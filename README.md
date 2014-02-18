# SwmCache-Twig-Extension
Flat Cache part of your content in Twig. Perfect to reduce render() gen time. Twig cache extension that work without dependency.

[![Total Downloads](https://poser.pugx.org/scullwm/swmcache-twig-extension/downloads.png)](https://packagist.org/packages/scullwm/swmcache-twig-extension)

## Why
Couldn't find a simple twig cache extension that don't need many libs. Here it just use the Twig Cache Folder

## Installation
The extension is installable via composer:
```json
{
    "require": {
        "scullwm/swmcache-twig-extension": "dev-master"
    }
}
```

## Usage
```php
<?php
// Declare Namespace
use SwmCacheTwig\SwmCacheTwig;

// Add Extension to Twig (here silex way)
$twig->addExtension(new SwmCacheTwig());
?>
```
## How to use ?
```php
    {% swmcache 'ephemeride' '3600' %}
        {{ render(url('page_ephemeride')) }}
    {% endswmcache %}
```
## Todo
- Write tests