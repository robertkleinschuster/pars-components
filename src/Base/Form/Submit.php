<?php


namespace Pars\Component\Base\Form;


use Pars\Component\Base\StyleAwareInterface;
use Pars\Component\Base\StyleAwareTrait;

class Submit extends Input implements StyleAwareInterface
{
    use StyleAwareTrait;

    public function __construct(?string $style = null)
    {
        parent::__construct();
        if (null !== $style) {
            $this->setStyle($style);
        }
    }


    protected function initialize()
    {
        $this->setType(self::TYPE_SUBMIT);
        parent::initialize();
        $this->addOption('btn');
        if ($this->hasStyle()) {
            $this->addOption('btn-' . $this->getStyle());
        }
    }

}
