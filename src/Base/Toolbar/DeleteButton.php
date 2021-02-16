<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class DeleteButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(self::STYLE_DANGER);
        $icon = new Icon(Icon::ICON_TRASH);
        $this->push($icon);
        parent::initialize();
    }
}
