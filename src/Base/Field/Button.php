<?php


namespace Pars\Component\Base\Field;


use Pars\Component\Base\BorderAwareInterface;
use Pars\Component\Base\StyleAwareInterface;
use Pars\Component\Base\StyleAwareTrait;
use Pars\Mvc\View\AbstractField;

class Button extends AbstractField implements StyleAwareInterface
{
    use StyleAwareTrait;

    public bool $outline = false;
    public string $type = 'button';
    public ?string $name = null;
    public ?string $value = null;

    public function __construct(?string $content = null, ?string $style = null, ?string $path = null)
    {
        parent::__construct($content);
        $this->style = $style;
        $this->path = $path;
    }


    protected function initialize()
    {
        $this->setTag('button');
        $this->setAttribute('type', $this->getType());
        if ($this->hasName()) {
            $this->setAttribute('name', $this->getName());
        }
        if ($this->hasValue()) {
            $this->setAttribute('value', $this->getValue());
        }
        $this->addOption('btn');
        $this->addOption('mr-1');
        $this->addOption(BorderAwareInterface::ROUNDED_NONE);
        if ($this->hasStyle()) {
            if ($this->isOutline()) {
                $this->addOption('btn-outline-' . $this->getStyle());
            } else {
                $this->addOption('btn-' . $this->getStyle());
            }
        }
    }

    /**
    * @return string
    */
    public function getName(): string
    {
        return $this->name;
    }

    /**
    * @param string $name
    *
    * @return $this
    */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasName(): bool
    {
        return isset($this->name);
    }


    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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


    /**
     * @param string $name
     */
    public function addIcon(string $name)
    {
        $icon = new Icon($name);
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
