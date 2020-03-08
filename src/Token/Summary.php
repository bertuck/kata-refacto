<?php

/**
 * id : summary
 * type : quote
 * Class Summary
 */
class Summary extends Token
{
    protected $type = 'quote';

    /**
     * @param string $text
     * @param ApplicationContext $context
     * @return string
     */
    public function replace(string $text, ApplicationContext $context) : string
    {
        $quoteFromRepository = QuoteRepository::getInstance()
            ->getById($context->getCurrentQuote()->getId());
        return str_replace("[$this->type:$this->id]", Quote::renderText($quoteFromRepository), $text);
    }
}