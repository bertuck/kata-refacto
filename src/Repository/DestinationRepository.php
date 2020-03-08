<?php

/**
 * Class DestinationRepository
 */
class DestinationRepository implements Repository
{
    use SingletonTrait;

    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $conjunction;

    /**
     * @var string
     */
    private $computerName;

    /**
     * DestinationRepository constructor.
     */
    public function __construct()
    {
        $this->country = \Faker\Factory::create()->country;
        $this->conjunction = 'en';
        $this->computerName = \Faker\Factory::create()->slug();
    }

    /**
     * @param $id
     * @return Destination
     */
    public function getById($id) : Destination
    {
        // DO NOT MODIFY THIS METHOD
        return new Destination(
            $id,
            $this->country,
            $this->conjunction,
            $this->computerName
        );
    }
}
