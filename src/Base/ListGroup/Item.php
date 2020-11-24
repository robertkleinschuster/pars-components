<?php

namespace Pars\Component\Base\ListGroup;

use Pars\Mvc\View\AbstractComponent;

class Item extends AbstractComponent
{
    public bool $active = false;
    public bool $disable = false;

    protected function initialize()
    {
        $this->addOption('list-group-item');
        $this->addOption('flex-fill');
        if ($this->hasPath()) {
            $this->addOption('list-group-item-action');
        }
        if ($this->isActive()) {
            $this->addOption('active');
        }
        if ($this->isDisable()) {
            $this->addOption('disabled');
            $this->setAria('disabled', 'true');
            $this->setAttribute('tabindex', '-1');
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
     * @return Item
     */
    public function setActive(bool $active): Item
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisable(): bool
    {
        return $this->disable;
    }

    /**
     * @param bool $disable
     * @return Item
     */
    public function setDisable(bool $disable): Item
    {
        $this->disable = $disable;
        return $this;
    }


}
