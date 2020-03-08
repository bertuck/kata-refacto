<?php

/**
 * Class Site
 */
class Site extends Entity
{
    /**
     * @var string
     */
    protected $url;

    /**
     * Site constructor.
     * @param int $id
     * @param string $url
     */
    public function __construct(int $id, string $url)
    {
        $this->id = $id;
        $this->type = 'site';
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }
}
