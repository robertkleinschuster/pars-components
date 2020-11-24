<?php


namespace Pars\Component\Base\Field;


use Pars\Mvc\View\AbstractField;

class Span extends AbstractField
{
    protected function initialize()
    {
        $this->setTag('span');
    }

}
