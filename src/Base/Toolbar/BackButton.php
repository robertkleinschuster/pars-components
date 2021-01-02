<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;

class BackButton extends Button
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
        $this->setStyle(self::STYLE_SECONDARY);
        $icon = new Icon(Icon::ICON_ARROW_LEFT_CIRCLE);
        $this->push($icon);
        parent::initialize();
    }
}
