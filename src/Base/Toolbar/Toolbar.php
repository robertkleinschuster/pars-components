<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Mvc\View\AbstractComponent;


class Toolbar extends AbstractComponent
{
    protected function initialize()
    {
        $this->addOption('btn-toolbar');
        $this->addOption('mb-4');
        parent::initialize();
    }

}
