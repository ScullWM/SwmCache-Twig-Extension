<?php

namespace SwmCacheTwig\TokenParser;

use SwmCacheTwig\Node\SwmCacheNode;

class SwmCacheTokenParser extends \Twig_TokenParser implements \Twig_TokenParserInterface
{
    /**
     * How tag end
     *
     * @version  21-01-14
     * @param  Twig_Token $token
     * @return Twig_Token
     */
    public function decideswmcacheEnd(\Twig_Token $token)
    {
        return $token->test('endswmcache');
    }

    /**
     * Tag that use extension
     *
     * @version  19-01-14
     * @return String Tag name
     */
    public function getTag()
    {
        return 'swmcache';
    }

    /**
     * Parse function
     *
     * @version  19-01-14
     * @param  Twig_Token $token All information about tag content
     * @return SwmCacheNode      Cache strategy
     */
    public function parse(\Twig_Token $token)
    {
        $stream = $this->parser->getStream();

        $refInfo = $stream->expect(\Twig_Token::STRING_TYPE)->getValue();
        $keyInfo = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse(array($this, 'decideswmcacheEnd'), true);
        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new SwmCacheNode($refInfo, $keyInfo, $body);
     }
}