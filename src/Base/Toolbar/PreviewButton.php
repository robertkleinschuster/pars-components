<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class PreviewButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(self::STYLE_INFO);
        $icon = new Icon(Icon::ICON_GLOBE);
        $this->push($icon);
        parent::initialize();
    }
}
