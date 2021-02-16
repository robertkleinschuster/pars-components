<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class BackButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(self::STYLE_SECONDARY);
        $icon = new Icon(Icon::ICON_ARROW_LEFT_CIRCLE);
        $this->push($icon);
        $this->addOption('cache');
        parent::initialize();
    }
}
