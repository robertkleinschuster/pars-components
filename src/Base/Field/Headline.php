<?php


namespace Pars\Component\Base\Field;


use Pars\Mvc\View\AbstractField;

class Headline extends AbstractField
{
    public function __construct(?string $content = null, ?string $label = null)
    {
        parent::__construct($content, $label);
    }


    protected function initialize()
    {
        $this->setTag('h1');
    }

}
