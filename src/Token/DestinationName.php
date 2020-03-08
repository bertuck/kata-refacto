<?php

/**
 * id : destination_name
 * type : quote
 * Class DestinationName
 */
class DestinationName extends Token
{
    protected $type = 'quote';

    /**
     * @param string $text
     * @param ApplicationContext $context
     * @return string
     */
    public function replace(string $text, ApplicationContext $context) : string
    {
        $destinationOfQuote = DestinationRepository::getInstance()
            ->getById($context->getCurrentQuote()->getDestinationId());
        if ($destinationOfQuote) {
            return str_replace("[$this->type:$this->id]", $destinationOfQuote->getCountryName(), $text);
        }
        return $text;
    }
}