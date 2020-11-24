<?php


namespace Pars\Component\Base\Form;


use Pars\Mvc\View\AbstractField;

class Hint extends AbstractField
{
    protected function initialize()
    {
        $this->setTag('small');
        $this->addOption('form-text');
        $this->addOption('text-muted');
    }

}
