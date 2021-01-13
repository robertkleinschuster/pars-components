<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Button;

class ToolbarButton extends Button
{
    protected function initialize()
    {
        $this->addOption('my-2');
        parent::initialize();
    }

}
