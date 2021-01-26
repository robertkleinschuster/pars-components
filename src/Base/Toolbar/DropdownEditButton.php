<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\DropdownButton;

class DropdownEditButton extends DropdownButton
{
    protected function initialize()
    {
        parent::initialize();
        $this->getDropdownButton()->addOption('my-2');
        $this->getDropdownButton()->setStyle(Button::STYLE_WARNING);
        $this->getButton()->removeOption('mr-1');
    }

}
