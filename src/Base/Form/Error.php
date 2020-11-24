<?php


namespace Pars\Component\Base\Form;


use Pars\Mvc\View\AbstractField;

class Error extends AbstractField
{
    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('invalid-feedback');
    }

}
