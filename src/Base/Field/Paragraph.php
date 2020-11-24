<?php


namespace Pars\Component\Base\Field;


use Pars\Mvc\View\AbstractField;

class Paragraph extends AbstractField
{
    protected function initialize()
    {
        $this->setTag('p');
    }

}
