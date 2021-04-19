<?php

namespace Pars\Component\Base\Filter;

use Pars\Component\Base\Collapsable\Collapsable;
use Pars\Component\Base\Edit\Edit;
use Pars\Component\Base\Toolbar\FilterButton;
use Pars\Mvc\View\Event\ViewEvent;

/**
 * Class Filter
 * @package Pars\Component\Base\Filter
 */
class Filter extends Edit
{

    protected ?Collapsable $collapsable = null;

    protected function initForm()
    {
        parent::initForm();
        if ($this->hasId()) {
            $this->getForm()->setId($this->getId() . '_form');
            $this->getCollapsable()->setId($this->getId() . '_collapsable');
        }
    }


    protected function handleForm()
    {
        $this->getCollapsable()->pushComponent($this->getForm());
        $this->getMain()->push($this->getCollapsable());
    }


    public function getCollapsable(): Collapsable
    {
        if (!isset($this->collapsable)) {
            $this->collapsable = new Collapsable();
        }
        return $this->collapsable;
    }

}
