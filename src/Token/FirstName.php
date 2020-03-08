<?php

/**
 * id : first_name
 * type : user
 * Class FirstName
 */
class FirstName extends Token
{
    protected $type = 'user';

    /**
     * @param string $text
     * @param ApplicationContext $context
     * @return string
     */
    public function replace(string $text, ApplicationContext $context) : string
    {
        return str_replace("[$this->type:$this->id]", ucfirst(mb_strtolower($context->getCurrentUser()->getFirstname())), $text);
    }
}