<?php


/**
 * id : destination_link
 * type : quote
 * Class DestinationLink
 */
class DestinationLink extends Token
{
    protected $type = 'quote';

    /**
     * @param string $text
     * @param ApplicationContext $context
     * @return string
     */
    public function replace(string $text, ApplicationContext $context) : string
    {
        $siteRepository = SiteRepository::getInstance()
            ->getById($context->getCurrentSite()->getId());
        $destinationRepository = DestinationRepository::getInstance()
            ->getById($context->getCurrentQuote()->getDestinationId());
        if (isset($destinationRepository)) {
            return str_replace("[$this->type:$this->id]",$siteRepository->getUrl() . '/' . $destinationRepository->getConjunction() .  '/' . $destinationRepository->getCountryNameUri() . '/quote/' . $context->getCurrentQuote()->getId(), $text);;
        }
        return $text;
    }
}