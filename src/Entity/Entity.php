<?php

/**
 * Class Entity
 */
abstract class Entity
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @return int
     */
    public function getId() : int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType() : string {
        return $this->type;
    }
}