<?php

/**
 * Class ApplicationContext
 */
class ApplicationContext
{
    use SingletonTrait;

    /**
     * @var Site
     */
    protected $currentSite;

    /**
     * @var User
     */
    protected $currentUser;

    /**
     * @var Quote
     */
    protected $currentQuote;


    /**
     * ApplicationContext constructor.
     */
    protected function __construct()
    {
        $faker = \Faker\Factory::create();
        $this->currentSite = new Site($faker->randomNumber(), $faker->url);
        $this->currentUser = new User($faker->randomNumber(), $faker->firstName, $faker->lastName, $faker->email);
        $this->currentQuote = new Quote($faker->randomNumber(), $faker->randomNumber(), $faker->randomNumber(), $faker->dateTimeBetween());
    }

    /**
     * @param array $data
     */
    public function update(array $data) {
        $this->setCurrentSite($data);
        $this->setCurrentUser($data);
        $this->setCurrentQuote($data);
    }

    /**
     * @return Site
     */
    public function getCurrentSite() : Site
    {
        return $this->currentSite;
    }

    /**
     * @return User
     */
    public function getCurrentUser() : User
    {
        return $this->currentUser;
    }

    /**
     * @return Quote
     */
    public function getCurrentQuote() : Quote
    {
        return $this->currentQuote;
    }

    /**
     * @param array $data
     */
    public function setCurrentSite(array $data)
    {
        if (isset($data['site']) && $data['site'] instanceof Site) {
            $this->currentSite = $data['site'];
        }
    }

    /**
     * @param array $data
     */
    public function setCurrentUser(array $data)
    {
        if (isset($data['user']) && $data['user'] instanceof User) {
            $this->currentUser = $data['user'];
        }
    }

    /**
     * @param array $data
     */
    public function setCurrentQuote(array $data)
    {
        if (isset($data['quote']) && $data['quote'] instanceof Quote) {
            $this->currentQuote = $data['quote'];
        }
    }
}
