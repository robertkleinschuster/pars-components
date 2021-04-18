<?php

namespace Pars\Component\Base\Filter;

use Pars\Component\Base\Edit\Edit;
use Pars\Component\Base\Toolbar\FilterButton;
use Pars\Mvc\View\Event\ViewEvent;

/**
 * Class Filter
 * @package Pars\Component\Base\Filter
 */
class Filter extends Edit
{
    protected FilterButton $button;

    protected function initEvent()
    {
        parent::initEvent();
        $this->getForm()->setId($this->getId() . '_form');
        $this->getButton()->setId($this->getId() . '_button');
        $event = ViewEvent::createCallback(function () {
            $this->getForm()->addOption('show');
        });
        $event->setPath($this->getPathHelper(false)->getPath());
        $this->getButton()->setEvent($event);
        $event->setTargetId($this->getForm()->getId());
    }


    protected function initialize()
    {
        $button = $this->getButton();
        $button->addOption('show-filter');
        $button->setData('toggle', 'collapse');
        $button->setData('target', '#' . $this->getForm()->getId());
        #  $this->push($button);
        $this->getForm()->addOption('collapse');
        parent::initialize();
    }

    /**
     * @return FilterButton
     */
    public function getButton(): FilterButton
    {
        if (!isset($this->button)) {
            $this->button = new FilterButton();
        }
        return $this->button;
    }

}
