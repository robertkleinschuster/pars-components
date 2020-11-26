<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElementList;

class Collapse extends AbstractComponent
{
    protected ?HtmlElementList $itemList = null;

    public ?string $active = null;

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('collapse');
        $this->addOption('navbar-collapse');
        if ($this->hasActive()) {
            foreach ($this->getItemList() as $item) {
                if ($item->getId() === $this->getActive()) {
                    $item->setActive(true);
                }
            }
        }
        $group = new Group();
        $group->addOption('order-2');
        $group->setElementList($this->getItemList());
        $this->getElementList()->unshift($group);
    }

    /**
     * @param Item $item
     */
    public function addItem(Item $item)
    {
        $this->getItemList()->push($item);
    }

    /**
     * @return HtmlElementList|null
     */
    protected function getItemList()
    {
        if (null === $this->itemList) {
            $this->itemList = new HtmlElementList();
        }
        return $this->itemList;
    }

    /**
     * @return string
     */
    public function getActive(): string
    {
        return $this->active;
    }

    /**
     * @param string $active
     *
     * @return $this
     */
    public function setActive(string $active): self
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasActive(): bool
    {
        return isset($this->active);
    }

}
