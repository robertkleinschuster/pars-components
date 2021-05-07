<?php


namespace Pars\Component\Base\Form;


use Pars\Component\Base\StyleAwareInterface;

/**
 * Class Reset
 * @package Pars\Component\Base\Form
 */
class Reset extends Input implements StyleAwareInterface
{
    use \Pars\Component\Base\StyleAwareTrait;

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
        $this->setType(self::TYPE_RESET);
        parent::initialize();
        $this->setTag('button');
        $this->removeOption('form-control');
        $this->addOption('btn');
        if ($this->hasStyle()) {
            $this->addOption('btn-' . $this->getStyle());
        }
    }

}
