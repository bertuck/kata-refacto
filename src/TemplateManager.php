<?php

class TemplateManager
{
    /**
     * @var ApplicationContext
     */
    protected $context;

    /**
     * TemplateManager constructor.
     */
    public function __construct() {
        $this->context = ApplicationContext::getInstance();
    }

    /**
     * @param Template $template
     * @param array $data
     * @return Template
     */
    public function getTemplateComputed(Template $template, array $data) : Template
    {
        if (!$template) {
            throw new \RuntimeException('no tpl given');
        }
        return $this->computeTexts($template, $data);
    }

    /**
     * @param Template $template
     * @param array $data
     * @return Template
     */
    private function computeTexts(Template $template, array $data) : Template
    {
        $replaced = clone($template);
        foreach ($replaced as $key => $text) {
            if ($key !== 'id') {
                $this->computeText($replaced->{$key}, $data);
            }
        }
        return $replaced;
    }

    /**
     * @param string $text
     * @param array $data
     */
    private function computeText(string &$text, array $data)
    {
        $quote = (isset($data['quote']) and $data['quote'] instanceof Quote) ? $data['quote'] : null;

        if ($quote)
        {
            $_quoteFromRepository = QuoteRepository::getInstance()->getById($quote->id);
            $usefulObject = SiteRepository::getInstance()->getById($quote->siteId);
            $destinationOfQuote = DestinationRepository::getInstance()->getById($quote->destinationId);

            if(strpos($text, '[quote:destination_link]') !== false){
                $destination = DestinationRepository::getInstance()->getById($quote->destinationId);
            }

            $containsSummaryHtml = strpos($text, '[quote:summary_html]');
            $containsSummary     = strpos($text, '[quote:summary]');

            if ($containsSummaryHtml !== false || $containsSummary !== false) {
                if ($containsSummaryHtml !== false) {
                    $text = str_replace(
                        '[quote:summary_html]',
                        Quote::renderHtml($_quoteFromRepository),
                        $text
                    );
                }
                if ($containsSummary !== false) {
                    $text = str_replace(
                        '[quote:summary]',
                        Quote::renderText($_quoteFromRepository),
                        $text
                    );
                }
            }

            (strpos($text, '[quote:destination_name]') !== false) and $text = str_replace('[quote:destination_name]',$destinationOfQuote->countryName,$text);
        }

        if (isset($destination))
            $text = str_replace('[quote:destination_link]', $usefulObject->url . '/' . $destination->countryName . '/quote/' . $_quoteFromRepository->id, $text);
        else
            $text = str_replace('[quote:destination_link]', '', $text);

        /*
         * USER
         * [user:*]
         */
        $_user  = (isset($data['user'])  and ($data['user']  instanceof User))  ? $data['user']  : $this->context->getCurrentUser();
        if($_user) {
            (strpos($text, '[user:first_name]') !== false) and $text = str_replace('[user:first_name]'       , ucfirst(mb_strtolower($_user->firstname)), $text);
        }
    }
}
