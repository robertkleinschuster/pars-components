<?php


namespace Pars\Component\Base\Pagination;


use Pars\Mvc\View\AbstractField;

class PaginationItem extends AbstractField
{
    protected bool $active = false;
    protected bool $disabled = false;

    protected function initialize()
    {
        $this->setTag('li');
        $this->addOption('page-item');
        if ($this->isActive()) {
            $this->addOption('active');
            $this->setAria('current', 'page');
        }
        if ($this->isDisabled()) {
            $this->addOption('disabled');
            $this->setAria('disabled', 'true');
        }
        parent::initialize();
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return PaginationItem
     */
    public function setActive(bool $active): PaginationItem
    {
        $this->active = $active;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return PaginationItem
     */
    public function setDisabled(bool $disabled): PaginationItem
    {
        $this->disabled = $disabled;
        return $this;
    }





}
