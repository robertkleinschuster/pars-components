<?php


namespace Pars\Component\Base\Grid;


use Pars\Component\Base\BackgroundAwareInterface;
use Pars\Component\Base\BackgroundAwareTrait;
use Pars\Component\Base\BorderAwareInterface;
use Pars\Component\Base\BorderAwareTrait;
use Pars\Component\Base\BreakpointAwareInterface;
use Pars\Component\Base\BreakpointAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class Column extends AbstractComponent implements BreakpointAwareInterface, BackgroundAwareInterface, BorderAwareInterface
{
    use BreakpointAwareTrait;
    use BackgroundAwareTrait;
    use BorderAwareTrait;

    public ?int $size = null;
    public ?int $order = null;

    protected function initBase()
    {
        parent::initBase();
        $this->setTag('div');
        if ($this->hasBreakpoint()) {
            if ($this->hasSize()) {
                $this->addOption('col-' . $this->getBreakpoint() . '-' . $this->getSize());
            } else {
                $this->addOption('col-' . $this->getBreakpoint());
            }
        } else {
            if ($this->hasSize()) {
                $this->addOption('col-' . $this->getSize());
            } else {
                $this->addOption('col');
            }
        }
        if ($this->hasOrder()) {
            $this->addOption('order-' . $this->getOrder());
        }
        if ($this->hasBackground()) {
            $this->addOption($this->getBackground());
        }
        if ($this->hasBorder()) {
            $this->addOption('border');
            $this->addOption($this->getBorder());
        }
        if ($this->hasRounded()) {
            $this->addOption($this->getRounded());
        }
    }


    protected function handleFields()
    {
        foreach ($this->getFieldList() as $field) {
            $this->getMain()->push($field);
        }
    }


    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return $this
     */
    public function setSize(int $size): self
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSize(): bool
    {
        return $this->size !== null;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     *
     * @return $this
     */
    public function setOrder(int $order): self
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasOrder(): bool
    {
        return $this->order !== null;
    }


}
