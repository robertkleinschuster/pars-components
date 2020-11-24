<?php


namespace Pars\Component\Base\Field;


use Pars\Component\Base\StyleAwareInterface;
use Pars\Component\Base\StyleAwareTrait;
use Pars\Mvc\View\AbstractField;

class Button extends AbstractField implements StyleAwareInterface
{
    use StyleAwareTrait;

    public bool $outline = false;

    public function __construct(?string $content = null, ?string $style = null)
    {
        parent::__construct($content);
        $this->style = $style;
    }


    protected function initialize()
    {
        $this->setTag('button');
        $this->addOption('btn');
        $this->addOption('mr-1');
        if ($this->hasStyle()) {
            if ($this->isOutline()) {
                $this->addOption('btn-outline-' . $this->getStyle());
            } else {
                $this->addOption('btn-' . $this->getStyle());
            }
        }
    }

    /**
     * @param string $icon
     */
    public function addIcon(string $icon)
    {
        $icon = new Icon();
        $icon->setName($icon);
        $this->push($icon);
    }

    /**
     * @return bool
     */
    public function isOutline(): bool
    {
        return $this->outline;
    }

    /**
     * @param bool $outline
     * @return Button
     */
    public function setOutline(bool $outline): Button
    {
        $this->outline = $outline;
        return $this;
    }
}
