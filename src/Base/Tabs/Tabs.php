<?php


namespace Pars\Component\Base\Tabs;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ComponentInterface;
use Pars\Mvc\View\ComponentList;
use Pars\Mvc\View\HtmlElement;

class Tabs extends AbstractComponent
{
    protected ?ComponentList $componentList = null;
    protected int $active = 1;

    protected function initialize()
    {

        if ($this->getComponentList()->count()) {
            $tab_List = new HtmlElement('ul.nav.nav-tabs');
            if ($this->hasId()) {
                $tab_List->setId($this->getId() . '__list');
            }
            $tab_List->setRole('tablist');
            $tab_Content = new HtmlElement('div.tab-content');
            if ($this->hasId()) {
                $tab_Content->setId($this->getId() . '__content');
            }
            $i = 1;
            foreach ($this->getComponentList() as $component) {
                $component->handleInitialize();
                $tab = new HtmlElement('li.nav-item');
                $tab->setRole('presentation');
                $tab->setData('index', $i);
                $link = new HtmlElement('a.nav-link');
                if ($this->hasId()) {
                    $link->setId($this->getId() . '__tab__' . $i);
                }
                if ($component->hasName()) {
                    $link->setContent($component->getName());
                    $component->setName(null);
                }
                $link->setData('toggle', 'tab');
                $link->setAria('selected', 'false');
                $tab->push($link);
                $tab_List->push($tab);
                $pane = new HtmlElement('div.tab-pane.fade');
                if ($i === $this->active) {
                    $pane->addOption('show');
                    $pane->addOption('active');
                    $link->setAria('selected', 'true');
                    $link->addOption('active');
                }
                $pane->setRole('tabpanel');
                if ($link->hasId()) {
                    $pane->setAria('labelledby', $link->getId());
                }
                if ($this->hasId()) {
                    $pane->setId($this->getId() . '__pane__' . $i);
                    $link->setAttribute('href', '#' . $pane->getId());
                    $link->setAria('controls', $pane->getId());
                }
                $pane->push($component);
                $tab_Content->push($pane);
                $i++;
            }
            $this->push($tab_List);
            $this->push($tab_Content);
        }
        parent::initialize();
    }

    /**
     * @return ComponentList|null
     */
    public function getComponentList(): ?ComponentList
    {
        if (null === $this->componentList) {
            $this->componentList = new ComponentList();
        }
        return $this->componentList;
    }

    /**
     * @return int
     */
    public function getActive(): int
    {
        return $this->active;
    }

    /**
     * @param int $active
     */
    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    /**
     * @param ComponentInterface $component
     * @return $this
     */
    public function append(ComponentInterface $component)
    {
        $this->getComponentList()->push($component);
        return $this;
    }

    /**
     * @param ComponentInterface $component
     * @return $this
     */
    public function prepend(ComponentInterface $component)
    {
        $this->getComponentList()->unshift($component);
        return $this;
    }


}