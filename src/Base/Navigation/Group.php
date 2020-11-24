<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractComponent;

class Group extends AbstractComponent
{
    protected function initialize()
    {
       $this->setTag('ul');
       $this->addOption('navbar-nav');
       $this->addOption('mr-auto');
    }

}
