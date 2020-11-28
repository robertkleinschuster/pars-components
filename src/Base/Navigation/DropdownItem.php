<?php


namespace Pars\Component\Base\Navigation;


class DropdownItem extends Link
{
    protected function initialize()
    {
        parent::initialize();
        $this->removeOption('nav-link');
        $this->addOption('dropdown-item');
    }
}
