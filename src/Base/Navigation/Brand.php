<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractField;

class Brand extends AbstractField
{
    protected function initialize()
    {
        $this->setTag('a');
        if ($this->hasPath()) {
            $this->setAttribute('href', $this->getPath());
            $this->setPath(null);
        }
        $this->addOption('navbar-brand');
    }

}
