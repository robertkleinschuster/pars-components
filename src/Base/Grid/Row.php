<?php


namespace Pars\Component\Base\Grid;


use Pars\Component\Base\BorderAwareInterface;
use Pars\Component\Base\BorderAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class Row extends AbstractComponent implements BorderAwareInterface
{
    use BorderAwareTrait;

    public const OPTION_NO_GUTTERS = 'no-gutters';

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('row');
        if ($this->hasBorder()) {
            $this->addOption($this->getBorder());
            if (!$this->hasBorderPosition()) {
                $this->addOption('border');
            }
        }
        if ($this->hasBorderPosition()) {
            $this->addOption($this->getBorderPosition());
        }
        if ($this->hasRounded()) {
            $this->addOption($this->getRounded());
        }
    }
}
