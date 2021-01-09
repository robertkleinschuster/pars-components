<?php


namespace Pars\Component\Base\Ajax;


use Pars\Mvc\View\AbstractComponent;

class Ajax extends AbstractComponent
{
    protected ?string $component = null;
    protected bool $onload = false;
    protected bool $history = false;

    protected function initialize()
    {
        $this->addOption('ajax');
        if ($this->isOnload()) {
            $this->addOption('onload');
        }
        if ($this->isHistory()) {
            $this->addOption('history');
        }
        if ($this->hasComponent()) {
            $this->setData('component', $this->getComponent());
        }
        if ($this->hasPath()) {
            $this->setData('href', $this->getPath());
            $this->setPath(null);
        }
        parent::initialize();
    }


    /**
    * @return string
    */
    public function getComponent(): string
    {
        return $this->component;
    }

    /**
    * @param string $component
    *
    * @return $this
    */
    public function setComponent(string $component): self
    {
        $this->component = $component;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasComponent(): bool
    {
        return isset($this->component);
    }


    /**
     * @return bool
     */
    public function isOnload(): bool
    {
        return $this->onload;
    }

    /**
     * @param bool $onload
     */
    public function setOnload(bool $onload): void
    {
        $this->onload = $onload;
    }

    /**
     * @return bool
     */
    public function isHistory(): bool
    {
        return $this->history;
    }

    /**
     * @param bool $history
     */
    public function setHistory(bool $history): void
    {
        $this->history = $history;
    }




}
