<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class CheckButton extends ToolbarButton
{
    protected function initialize()
    {
        $icon = new Icon(Icon::ICON_CHECK);
        $this->push($icon);
        parent::initialize();
    }

}
