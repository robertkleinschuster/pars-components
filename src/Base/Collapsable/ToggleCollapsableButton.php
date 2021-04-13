<?php


namespace Pars\Component\Base\Collapsable;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;

class ToggleCollapsableButton extends Button
{

    protected string $collapseTarget;
    protected bool $toggle = false;

    public function __construct(string $target)
    {
        parent::__construct();
        $this->collapseTarget = $target;
    }

    protected function initialize()
    {
        parent::initialize();
        $icon = new Icon($this->isToggle() ? Icon::ICON_CHEVRONS_UP : Icon::ICON_CHEVRONS_DOWN);
        $this->push($icon);

        $this->setStyle(Button::STYLE_LIGHT);
        $this->setData('toggle', 'collapse');
        $this->setData('target', '#' . $this->collapseTarget);
    }

    /**
     * @return bool
     */
    public function isToggle(): bool
    {
        return $this->toggle;
    }

    /**
     * @param bool $toggle
     * @return ToggleCollapsableButton
     */
    public function setToggle(bool $toggle): ToggleCollapsableButton
    {
        $this->toggle = $toggle;
        return $this;
    }

}