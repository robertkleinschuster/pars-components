<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElementList;

class Collapse extends AbstractComponent
{
    protected ?HtmlElementList $itemList = null;

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('collapse');
        $this->addOption('navbar-collapse');
        $group = new Group();
        $group->addOption('order-2');
        $group->setElementList($this->getitemList());
        $this->getElementList()->unshift($group);
    }

    public function addItem(Item $item) {
        $this->getitemList()->push($item);
    }

    /**
     * @param string $id
     */
    public function setActive(string $id): self
    {
        foreach ($this->getitemList() as $item) {
            if ($item->getId() === $id) {
                $item->setActive(true);
            }
        }
        return $this;
    }

    protected function getitemList()
    {
        if (null === $this->itemList) {
            $this->itemList = new HtmlElementList();
        }
        return $this->itemList;
    }
}
