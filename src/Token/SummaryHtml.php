<?php

/**
 * id : summary_html
 * type : quote
 * Class SummaryHtml
 */
class SummaryHtml extends Token
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
        return str_replace("[$this->type:$this->id]", Quote::renderHtml($quoteFromRepository), $text);
    }
}