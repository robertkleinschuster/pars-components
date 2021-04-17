<?php


namespace Pars\Component\Base\Field;


use Pars\Component\Base\StyleAwareInterface;
use Pars\Component\Base\StyleAwareTrait;
use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\ViewElement;

class Progress extends AbstractField implements StyleAwareInterface
{
    use StyleAwareTrait;

    public ?string $value = null;

    /**
     * Progress constructor.
     * @param string|null $value
     */
    public function __construct(?string $value)
    {
        parent::__construct();
        $this->value = $value;
    }


    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('progress');
        $bar = new ViewElement('div');
        $bar->setRole('progressbar');
        if ($this->hasValue()) {
            $bar->addInlineStyle('width', "{$this->getValue()}%");
            $bar->setAria('valuenow', $this->getValue());
        }
        $bar->setAria('valuemin', '0');
        $bar->setAria('valuemax', '100');
        $bar->addOption('progress-bar');
        $bar->addOption('progress-bar-striped');
        if ($this->hasStyle()) {
            $bar->addOption('bg-' . $this->getStyle());
        } else {
            $bar->addOption('bg-' . self::STYLE_INFO);
        }
        $this->push($bar);
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return isset($this->value);
    }


}
