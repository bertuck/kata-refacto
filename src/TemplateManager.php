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
        try {
            if (!$template) {
                throw new \RuntimeException('no tpl given');
            }
            return $this->computeTexts($template, $data);
        } catch (RuntimeException $e) {
            echo "Error in TemplateManager - " . $e->getMessage() . "\n";
            exit;
        }
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
     * @return string
     */
    private function computeText(string &$text, array $data)
    {
        $this->context->update($data);
        foreach (Token::NAMES as $token) {
            $tokenClass = Tools::generateClassName($token);
            $tokenObj = new $tokenClass($token);
            $text = $tokenObj->replace($text, $this->context);
        }
        return $text;
    }
}
