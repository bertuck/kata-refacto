<?php

/**
 * Class Template
 */
class Template extends Entity
{
    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $content;

    /**
     * Template constructor.
     * @param int $id
     * @param string $subject
     * @param string $content
     */
    public function __construct(int $id, string $subject, string $content)
    {
        $this->id = $id;
        $this->type = 'template';
        $this->subject = $subject;
        $this->content = $content;
    }
}