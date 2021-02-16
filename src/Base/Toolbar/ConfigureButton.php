<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class ConfigureButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(self::STYLE_DARK);
        $icon = new Icon(Icon::ICON_SETTINGS);
        $this->push($icon);
        parent::initialize();
    }
}
