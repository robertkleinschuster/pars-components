<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class RunButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(self::STYLE_SUCCESS);
        $icon = new Icon(Icon::ICON_PLAY);
        $this->push($icon);
        parent::initialize();
    }
}
