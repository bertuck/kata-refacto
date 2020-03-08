<?php

/**
 * Class Quote
 */
class Quote extends Entity
{
    /**
     * @var int
     */
    protected $siteId;

    /**
     * @var int
     */
    protected $destinationId;

    /**
     * @var DateTime
     */
    protected $dateQuoted;

    /**
     * Quote constructor.
     * @param int $id
     * @param int $siteId
     * @param int $destinationId
     * @param DateTime $dateQuoted
     */
    public function __construct(int $id, int $siteId, int $destinationId, DateTime $dateQuoted)
    {
        $this->id = $id;
        $this->type = 'quote';
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    /**
     * @param Quote $quote
     * @return string
     */
    public static function renderHtml(Quote $quote) : string
    {
        return '<p>' . $quote->id . '</p>';
    }

    /**
     * @param Quote $quote
     * @return string
     */
    public static function renderText(Quote $quote) : string
    {
        return (string) $quote->id;
    }

    /**
     * @return int
     */
    public function getSiteId() : int
    {
        return $this->siteId;
    }

    /**
     * @return int
     */
    public function getDestinationId() : int
    {
        return $this->destinationId;
    }

    /**
     * @return DateTime
     */
    public function getDateQuoted() : DateTime
    {
        return $this->dateQuoted;
    }
}