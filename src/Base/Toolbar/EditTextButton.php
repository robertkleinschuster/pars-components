<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class EditTextButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(self::STYLE_PRIMARY);
        $icon = new Icon(Icon::ICON_EDIT);
        $this->push($icon);
        parent::initialize();
    }
}
