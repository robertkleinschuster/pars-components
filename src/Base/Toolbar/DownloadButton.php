<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class DownloadButton extends ToolbarButton
{
    protected function initialize()
    {
        $this->setStyle(self::STYLE_SUCCESS);
        $icon = new Icon(Icon::ICON_DOWNLOAD);
        $this->push($icon);
        parent::initialize();
    }

}
