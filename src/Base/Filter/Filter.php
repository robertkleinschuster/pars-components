<?php

namespace Pars\Component\Base\Filter;

use Pars\Component\Base\Edit\Edit;
use Pars\Component\Base\Toolbar\FilterButton;

/**
 * Class Filter
 * @package Pars\Component\Base\Filter
 */
class Filter extends Edit
{
    protected FilterButton $button;

    protected function initialize()
    {
        $button = $this->getButton();
        $button->setData('toggle', 'collapse');
        $button->setData('target', '#' . $this->getForm()->generateId());
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
