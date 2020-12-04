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
    public ?string $confirmTitle = null;
    public ?string $confirmCancel = null;

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
        if ($this->hasConfirm()) {
            $this->addOption('confirm-modal');
            $this->setData('confirm-title', $this->getConfirmTitle());
            if ($this->hasConfirmCancel()) {
                $this->setData('confirm-cancel', $this->getConfirmCancel());
            }
            $this->setData('toggle', 'modal');
            $this->setData('target', '#confirm-modal');
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

    /**
    * @return string
    */
    public function getConfirmTitle(): string
    {
        return $this->confirmTitle;
    }

    /**
    * @param string $confirmTitle
    *
    * @return $this
    */
    public function setConfirm(string $confirmTitle): self
    {
        $this->confirmTitle = $confirmTitle;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasConfirm(): bool
    {
        return isset($this->confirmTitle);
    }

    /**
     * @return string|null
     */
    public function getConfirmCancel(): ?string
    {
        return $this->confirmCancel;
    }

    /**
     * @param string|null $confirmCancel
     */
    public function setConfirmCancel(?string $confirmCancel): void
    {
        $this->confirmCancel = $confirmCancel;
    }

    /**
     * @return bool
     */
    public function hasConfirmCancel(): bool
    {
        return isset($this->confirmCancel);
    }


}
