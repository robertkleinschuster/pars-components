<?php


namespace Pars\Component\Base\Collapsable;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;
use Pars\Mvc\View\ViewElement;

class ToggleCollapsableButton extends Button
{

    protected ViewElement $collapseTarget;
    protected bool $toggle = false;

    public function __construct(ViewElement $target)
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
        $this->setData('bs-toggle', 'collapse');
        $this->setData('bs-target', '#' . $this->collapseTarget->generateId());
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
