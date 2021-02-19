<?php


namespace Pars\Component\Base\Overview;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;

class DetailButton extends Button
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
        $this->setStyle(self::STYLE_INFO);
        $this->addInlineStyle('padding', '4px');
        $this->addInlineStyle('line-height', '1');
        $icon = new Icon(Icon::ICON_SEARCH);
        $icon->setWidth('14px');
        $this->push($icon);
        parent::initialize();
        $this->removeOption('mr-1');
        $this->addOption('btn-sm');
        $this->addOption('cache');
    }

}
