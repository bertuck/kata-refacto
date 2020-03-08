<?php

/**
 * id : last_name
 * type : user
 * Class FirstName
 */
class LastName extends Token
{
    protected $type = 'user';

    /**
     * @param string $text
     * @param ApplicationContext $context
     * @return string
     */
    public function replace(string $text, ApplicationContext $context) : string
    {
        return str_replace("[$this->type:$this->id]", ucfirst(mb_strtolower($context->getCurrentUser()->getLastname())), $text);
    }
}