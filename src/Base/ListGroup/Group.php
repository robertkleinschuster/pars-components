<?php


namespace Pars\Component\Base\ListGroup;


use Niceshops\Core\Mode\ModeAwareInterface;
use Niceshops\Core\Mode\ModeAwareTrait;
use Pars\Component\Base\BreakpointAwareInterface;
use Pars\Component\Base\BreakpointAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class Group extends AbstractComponent implements ModeAwareInterface, BreakpointAwareInterface
{
    use ModeAwareTrait;
    use BreakpointAwareTrait;

    public const MODE_FLUSH = 'flush';
    public const MODE_HORIZONTAL = 'horizontal';

    protected function initialize()
    {
        $this->addOption('list-group');
        if ($this->hasMode()) {
            if ($this->hasBreakpoint() && $this->getMode() === self::MODE_HORIZONTAL) {
                $this->addOption('list-group-' . $this->getMode() . '-' . $this->getBreakpoint());
            } else {
                $this->addOption('list-group-' . $this->getMode());
            }
        }
    }

}
