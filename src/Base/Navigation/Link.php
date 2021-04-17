<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\ViewElement;

class Link extends AbstractField
{
    public bool $active = false;

    protected function initialize()
    {
        $this->addOption('nav-link');
        $this->addOption(self::OPTION_DECORATION_NONE);
        if ($this->isActive()) {
            $this->addOption('active');
            $span = new ViewElement('span.sr-only');
            $span->setContent('(current)');
            $this->push($span);
        }
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Link
     */
    public function setActive(bool $active): Link
    {
        $this->active = $active;
        return $this;
    }


}
