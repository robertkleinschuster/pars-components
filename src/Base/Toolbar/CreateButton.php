<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;

class CreateButton extends ToolbarButton
{
    /**
     * DeleteButton constructor.
     */
    public function __construct(?string $path = null)
    {
        parent::__construct(null, null, $path);
    }

    protected function initialize()
    {
        $this->setStyle(self::STYLE_SUCCESS);
        $icon = new Icon(Icon::ICON_PLUS);
        $this->push($icon);
        parent::initialize();
    }
}
