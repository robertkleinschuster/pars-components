<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\FieldList;
use Pars\Mvc\View\ViewElement;

class Dropdown extends Item
{
    private ?FieldList $itemList = null;

    protected function initialize()
    {
        parent::initialize();
        $this->addOption('dropdown');
        $this->getLink()->setTag('a');
        $this->getLink()->setAttribute('href', '#');
        $this->getLink()->addOption('dropdown-toggle');
        $this->getLink()->setRole('button');
        $this->getLink()->setData('bs-toggle', 'dropdown');
        $this->getLink()->setAria('haspopup', 'true');
        $this->getLink()->setAria('expanded', 'false');
        $dropdownMenu = new ViewElement('div.dropdown-menu');
        $dropdownMenu->addInlineStyle('right', '0 !important');
        $dropdownMenu->addInlineStyle('left', 'auto !important');
        $dropdownMenu->setAria('labelledby', $this->getId());
        foreach ($this->getItemList() as $link) {
            $dropdownMenu->push($link);
        }
        $this->push($dropdownMenu);
    }

    /**
     * @return FieldList|null
     */
    protected function getItemList(): ?FieldList
    {
        if (null === $this->itemList) {
            $this->itemList = new FieldList();
        }
        return $this->itemList;
    }

    public function addItem(string $content, string $path)
    {
        $item = new DropdownItem($content);
        $item->setPath($path);
        $this->getItemList()->push($item);
        return $this;
    }


}
