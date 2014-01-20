<?php

namespace SwmCacheTwig\TokenParser;

class SwmCacheTokenParser extends \Twig_TokenParser implements \Twig_TokenParserInterface
{
    public function decideswmcacheEnd(\Twig_Token $token)
    {
        return $token->test('endswmcache');
    }

    public function getTag()
    {
        return 'swmcache';
    }

    public function parse(\Twig_Token $token)
    {
        $stream = $this->parser->getStream();

        $annotation = $stream->expect(\Twig_Token::STRING_TYPE)->getValue();
        $key = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideswmcacheEnd'), true);
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new CacheNode($annotation, $key, $body);
     }
}