<?php


namespace Pars\Component\Base\Form;


use Pars\Component\Base\StyleAwareInterface;
use Pars\Component\Base\StyleAwareTrait;
use Pars\Mvc\View\Event\ViewEvent;

class Submit extends Input implements StyleAwareInterface
{
    use StyleAwareTrait;

    public function __construct(string $content, ?string $style = null)
    {
        parent::__construct();
        $this->setContent($content);
        if (null !== $style) {
            $this->setStyle($style);
        }
    }


    protected function initialize()
    {
        $this->setType(self::TYPE_SUBMIT);
        parent::initialize();
        $this->setTag('button');
        $this->removeOption('form-control');
        $this->addOption('btn');
        $this->addOption('w-100');
        if ($this->hasStyle()) {
            $this->addOption('btn-' . $this->getStyle());
        }
    }

}
