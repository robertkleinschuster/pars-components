<?php


namespace Pars\Component\Base\Breadcrumb;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElement;
use Pars\Mvc\View\HtmlElementList;
use PHPUnit\TextUI\XmlConfiguration\Logging\TestDox\Html;

class Breadcrumb extends AbstractComponent
{
    protected ?HtmlElementList $itemList = null;

    protected function initialize()
    {
        parent::initialize();
        $this->setTag('nav');
        $this->setAria('label', 'breadcrumb');
        $ol = new HtmlElement('ol.breadcrumb');
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
        $item = new HtmlElement('li.breadcrumb-item');
        $link = new HtmlElement('span');
        $link->setPath($path);
        $link->setContent($title);
        $item->push($link);
        $this->getItemList()->push($item);
        return $this;
    }

    /**
     * @return HtmlElementList
     */
    public function getItemList(): HtmlElementList
    {
        if (!isset($this->itemList)) {
            $this->itemList = new HtmlElementList();
        }
        return $this->itemList;
    }

    /**
     * @param HtmlElementList $itemList
     * @return Breadcrumb
     */
    public function setItemList(HtmlElementList $itemList): Breadcrumb
    {
        $this->itemList = $itemList;
        return $this;
    }



}
