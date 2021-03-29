<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;

class FilterButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(Button::STYLE_SECONDARY);
        $this->addIcon(Icon::ICON_FILTER);
        parent::initialize();
    }

}
