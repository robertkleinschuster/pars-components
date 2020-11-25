<?php


namespace Pars\Component\Base\Field;


use Pars\Component\Base\ColorAwareInterface;
use Pars\Component\Base\ColorAwareTrait;
use Pars\Mvc\View\AbstractField;

class Span extends AbstractField implements ColorAwareInterface
{
    use ColorAwareTrait;

    protected function initialize()
    {
        $this->setTag('span');
        if ($this->hasColor()) {
            $this->addOption($this->getColor());
        } else {
            $this->addOption(self::COLOR_DARK);
        }
    }

}
