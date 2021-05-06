<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ViewElementList;

class Collapse extends AbstractComponent
{
    protected ?ViewElementList $itemList = null;
    protected ?ViewElementList $itemListRight = null;

    public ?string $active = null;

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('collapse');
        $this->addOption('navbar-collapse');
        if ($this->hasActive()) {
            foreach ($this->getItemList() as $item) {
                if ($this->hasActive() && $item->getId() === $this->getActive()) {
                    $item->setActive(true);
                }
            }
        }
        if (!$this->getItemListRight()->isEmpty()) {
            $groupRight = new Group();
            $groupRight->setRight(true);
            $groupRight->addOption('order-4');
            $groupRight->setElementList($this->getItemListRight());
            $this->getElementList()->unshift($groupRight);
        }
        $group = new Group();
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

    public function addItemRight(Item $item)
    {
        $this->getItemListRight()->push($item);
    }

    /**
     * @return ViewElementList|null
     */
    protected function getItemList()
    {
        if (null === $this->itemList) {
            $this->itemList = new ViewElementList();
        }
        return $this->itemList;
    }

    protected function getItemListRight()
    {
        if (null === $this->itemListRight) {
            $this->itemListRight = new ViewElementList();
        }
        return $this->itemListRight;
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

    public function isEmpty(): bool
    {
        return $this->getItemList()->isEmpty() && $this->getItemListRight()->isEmpty();
    }

}
