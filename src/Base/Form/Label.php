<?php


namespace Pars\Component\Base\Form;


use Pars\Mvc\View\AbstractField;

class Label extends AbstractField
{

    private ?string $for = null;

    protected function initialize()
    {
        $this->setTag('label');
        if ($this->hasParent() && !$this->getParent()->hasOption('form-floating')) {
            $this->addOption('form-label');
        }
        if ($this->hasFor()) {
            $this->setAttribute('for', $this->getFor());
        }
    }

    /**
     * @return string
     */
    public function getFor(): string
    {
        return $this->for;
    }

    /**
     * @param string $for
     *
     * @return $this
     */
    public function setFor(string $for): self
    {
        $this->for = $for;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasFor(): bool
    {
        return $this->for !== null;
    }

}
