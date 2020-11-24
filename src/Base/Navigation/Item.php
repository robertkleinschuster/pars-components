<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractField;

class Item extends AbstractField
{
    public bool $active = false;

    protected function initialize()
    {
        $this->setTag('li');
        $this->addOption('nav-item');
        $link = new Link();
        $link->setActive($this->isActive());
        if ($this->hasContent()) {
            $link->setContent($this->getContent());
            $this->set('content', null);
        }
        if ($this->hasPath()) {
            $link->setPath($this->getPath());
            $this->set('path', null);
        }
        $this->push($link);
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


}
