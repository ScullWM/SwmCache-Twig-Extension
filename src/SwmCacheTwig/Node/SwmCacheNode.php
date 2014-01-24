<?php

namespace SwmCacheTwig\Node;

class SwmCacheNode extends \Twig_Node
{
    private $keyInfo;

    public function __construct($refInfo, $keyInfo, $body)
    {
        parent::__construct(array('keyInfo' => $keyInfo, 'body' => $body), array('refInfo' => $refInfo));
    }

    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write("\$swmFlatCache = \$this->getEnvironment()->getExtension('Swm_Cache_extension')->getFlatCache(\$this->getEnvironment()->getCache());". PHP_EOL)
            ->write("\$swmCacheEmpreinte = \$swmFlatCache->getEmpreinte('".$this->getAttribute('refInfo')."','".$this->getNode('keyInfo')->getAttribute('value')."');". PHP_EOL)
            ->write("if(\$swmFlatCache->isCache(\$swmCacheEmpreinte)===false) {". PHP_EOL)
            ->indent()
                ->write("ob_start();". PHP_EOL)
                ->subcompile($this->getNode('body'))
                ->outdent()
            ->write("\$swmFlatCacheTmp = ob_get_clean();". PHP_EOL)
            ->write("\$swmFlatCache->setCache(\$swmFlatCacheTmp, \$swmCacheEmpreinte);". PHP_EOL)
            ->write("echo \$swmFlatCacheTmp;". PHP_EOL)
            ->write("} else {". PHP_EOL)
            ->indent()
                ->write("echo \$swmFlatCache->getCache(\$swmCacheEmpreinte);". PHP_EOL)
                ->outdent()
            ->write("}". PHP_EOL);
    }
}