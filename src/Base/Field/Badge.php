<?php


namespace Pars\Component\Base\Field;


use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Component\Base\StyleAwareTrait;
use Pars\Component\Base\StyleAwareInterface;
use Pars\Mvc\View\AbstractField;

class Badge extends AbstractField implements StyleAwareInterface
{
    use StyleAwareTrait;

    public function __construct(?string $content = null, ?string $style = null)
    {
        parent::__construct($content);
        $this->style = $style;
    }


    protected function initialize()
    {
        $this->setTag('span');
    }

    protected function beforeRender(BeanInterface $bean = null)
    {
        parent::beforeRender($bean);
        $this->clearOptions();
        $this->addOption('badge');
        if ($this->hasStyle()) {
            $this->addOption('badge-' . $this->getStyle());
        } else {
            $this->addOption('badge-' . self::STYLE_INFO);
        }
    }


}
