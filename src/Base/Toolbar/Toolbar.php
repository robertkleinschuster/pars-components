<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Mvc\View\AbstractComponent;


class Toolbar extends AbstractComponent
{
    public ?string $createPath = null;

    protected function initialize()
    {
        $this->addOption('btn-toolbar');
        parent::initialize();
    }

}
