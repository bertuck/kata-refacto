<?php

abstract class Token
{
    /**
     * @var string
     */
    protected $id;

    /**
     * Available tokens names
     * @var array
     */
    const NAMES = [
        'first_name',
        'last_name',
        'email',
        'destination_name',
        'destination_link',
        'summary_html',
        'summary'
    ];

    /**
     * Token constructor.
     * @param $id
     */
    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getID() : string {
        return $this->id;
    }

    /**
     * @param string $text
     * @param ApplicationContext $context
     * @return string
     */
    abstract public function replace(string $text, ApplicationContext $context) : string;
}