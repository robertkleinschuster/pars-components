<?php

namespace Pars\Component\Base\Field;

use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\HtmlElement;

class Codeblock extends AbstractField
{
    protected function initialize()
    {
        $this->setTag('pre');
        $code = new HtmlElement('code');
        if ($this->hasContent()) {
            $code->setContent($this->getContent());
        }
        $this->setContent('');
        $this->push($code);
    }
}
