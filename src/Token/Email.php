<?php

/**
 * id : email
 * type : user
 * Class Email
 */
class Email extends Token
{
    protected $type = 'user';

    /**
     * @param string $text
     * @param ApplicationContext $context
     * @return string
     */
    public function replace(string $text, ApplicationContext $context) : string
    {
        return str_replace("[$this->type:$this->id]", ucfirst(mb_strtolower($context->getCurrentUser()->getEmail())), $text);
    }
}