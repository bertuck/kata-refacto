<?php

/**
 * Class Destination
 */
class Destination extends Entity
{
    /**
     * @var string
     */
    protected $countryName;

    /**
     * @var string
     */
    protected $conjunction;

    /**
     * @var string
     */
    protected $computerName;

    /**
     * Destination constructor.
     * @param int $id
     * @param string $countryName
     * @param string $conjunction
     * @param string $computerName
     */
    public function __construct(int $id, string $countryName, string $conjunction, string $computerName)
    {
        $this->id = $id;
        $this->type = 'destination';
        $this->countryName = $countryName;
        $this->conjunction = $conjunction;
        $this->computerName = $computerName;
    }

    /**
     * @return string
     */
    public function getCountryName() : string
    {
        return $this->countryName;
    }

    /**
     * @return string
     */
    public function getConjunction() : string
    {
        return $this->conjunction;
    }

    /**
     * @return string
     */
    public function getComputerName() : string
    {
        return $this->computerName;
    }

    public function getCountryNameUri() : string
    {
        return Tools::cleanString($this->countryName);
    }
}
