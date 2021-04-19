<?php


namespace Pars\Component\Base\Breadcrumb;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ViewElement;
use Pars\Mvc\View\ViewElementList;
use PHPUnit\TextUI\XmlConfiguration\Logging\TestDox\Html;

class Breadcrumb extends AbstractComponent
{
    protected ?ViewElementList $itemList = null;

    protected function initialize()
    {
        parent::initialize();
        $this->setTag('nav');
        $this->setAria('label', 'breadcrumb');
        $ol = new ViewElement('ol.breadcrumb');
        $ol->addOption('bg-transparent');
        $ol->addOption('border-bottom');
        $ol->addOption('py-1');
        if (!$this->getItemList()->isEmpty()) {
            $this->getItemList()->last()->addOption('active');
            $this->getItemList()->last()->setAria('current', 'page');
        }
        foreach ($this->getItemList() as $item) {
            $ol->push($item);
        }
        $this->push($ol);
    }


    /**
     * @param string $title
     * @param string $path
     * @return $this
     */
    public function addItem(string $title, string $path)
    {
        $item = new ViewElement('li.breadcrumb-item');
        $link = new ViewElement('span');
        $link->setPath($path);
        $link->setContent($title);
        $item->push($link);
        $this->getItemList()->push($item);
        return $this;
    }

    /**
     * @return ViewElementList
     */
    public function getItemList(): ViewElementList
    {
        if (!isset($this->itemList)) {
            $this->itemList = new ViewElementList();
        }
        return $this->itemList;
    }

    /**
     * @param ViewElementList $itemList
     * @return Breadcrumb
     */
    public function setItemList(ViewElementList $itemList): Breadcrumb
    {
        $this->itemList = $itemList;
        return $this;
    }



}
