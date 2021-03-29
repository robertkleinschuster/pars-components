<?php


namespace Pars\Component\Base\Field;


use Pars\Component\Base\ColorAwareInterface;
use Pars\Component\Base\ColorAwareTrait;
use Pars\Mvc\View\AbstractField;

class Span extends AbstractField implements ColorAwareInterface
{
    use ColorAwareTrait;

    public function __construct(?string $content = null, ?string $label = null)
    {
        parent::__construct($content, $label);
        $this->setColor(self::COLOR_DARK);
    }


    protected function initialize()
    {
        $this->setTag('span');
    }

    /**
     * @param string $color
     * @return $this|Span
     */
    public function setColor(string $color)
    {
        if ($this->hasColor()) {
            $this->removeOption($this->getColor());
        }
        $this->color = $color;
        $this->addOption($color);
        return $this;
    }


}
