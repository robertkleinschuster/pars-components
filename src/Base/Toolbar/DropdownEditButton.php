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
        $button = clone $this->getButton();
        $button->initialize();
        $this->getDropdownButton()->setStyle($button->getStyle());
        $this->getButton()->removeOption('mr-1');
    }

}
