<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class EditButton extends ToolbarButton
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
        $this->setStyle(self::STYLE_WARNING);
        $icon = new Icon(Icon::ICON_EDIT_2);
        $this->push($icon);
        parent::initialize();
    }
}
