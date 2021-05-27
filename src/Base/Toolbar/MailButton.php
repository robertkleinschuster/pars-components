<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class MailButton extends ToolbarButton
{
    protected function initialize()
    {
        $icon = new Icon(Icon::ICON_MAIL);
        $this->push($icon);
        parent::initialize();
    }

}
