<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Button;

class ToolbarButton extends Button
{
    protected function initialize()
    {
        $this->addOption('mb-4');
        parent::initialize();
    }

}
