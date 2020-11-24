<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractField;

class Brand extends AbstractField
{
    protected function initialize()
    {
        $this->addOption('navbar-brand');
    }

}
