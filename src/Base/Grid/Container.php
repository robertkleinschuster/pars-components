<?php


namespace Pars\Component\Base\Grid;


use Pars\Pattern\Mode\ModeAwareInterface;
use Pars\Pattern\Mode\ModeAwareTrait;
use Pars\Component\Base\BreakpointAwareInterface;
use Pars\Component\Base\BreakpointAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class Container extends AbstractComponent implements BreakpointAwareInterface, ModeAwareInterface
{
    use BreakpointAwareTrait;
    use ModeAwareTrait;

    public const MODE_FLUID = 'fluid';

    protected function initialize()
    {
        $this->setTag('div');
        if ($this->hasBreakpoint()) {
            $this->addOption('container-' . $this->getBreakpoint());
        } elseif ($this->hasMode()) {
            $this->addOption('container-' . $this->getMode());
        } else {
            $this->addOption('container');
        }
    }

}
