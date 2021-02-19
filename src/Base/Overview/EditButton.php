<?php


namespace Pars\Component\Base\Overview;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;

class EditButton extends Button
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
        $this->setOutline(true);
        $this->setStyle(self::STYLE_WARNING);
        $this->addInlineStyle('padding', '4px');
        $this->addInlineStyle('line-height', '1');
        $icon = new Icon(Icon::ICON_EDIT_2);
        $icon->setWidth('14px');
        $this->push($icon);
        parent::initialize();
        $this->removeOption('mr-1');
        $this->addOption('btn-sm');
    }
}
