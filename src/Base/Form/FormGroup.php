<?php


namespace Pars\Component\Base\Form;


use Pars\Mvc\View\AbstractField;

class FormGroup extends AbstractField
{

    private ?Input $input = null;

    public ?string $name = null;
    public ?string $value = null;
    public ?string $hint = null;
    public ?string $error = null;
    public ?bool $floating = true;

    /**
     * FormGroup constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct();
        $this->name = $name;
    }

    protected function initialize()
    {
        $this->setTag('div');

        if ($this->hasInput()) {

            if ($this->hasName()) {
                $this->getInput()->setName($this->getName());
            }
            if ($this->getInput() instanceof Checkbox) {
                if ($this->hasLabel()) {
                    if (!$this->getInput()->hasLabel()) {
                        $this->getInput()->setLabel($this->getLabel());
                        $this->label = null;
                    }
                }
            }
            if ($this->getInput()->hasType() && $this->getInput()->getType() === Input::TYPE_HIDDEN) {
                $this->addOption('d-none');
            }
            if ($this->hasValue() && !$this->getInput()->hasValue()) {
                $this->getInput()->setValue($this->getValue());
            }
            if ($this->hasError()) {
                $this->getInput()->addOption('is-invalid');
            }
            $this->push($this->getInput());
        }
        if ($this->hasLabel()) {
            $label = new Label();
            if ($this->hasName()) {
                $label->setFor($this->getName());
            }
            $label->setContent($this->getLabel());
            if ($this->isFloating()) {
                $this->getElementList()->push($label);
                if ($this->hasInput()) {
                    $this->getInput()->setPlaceholder($this->getLabel());
                }
                $label->addOption('text-secondary');
                $this->addOption('form-floating');
            } else {
                $this->getElementList()->unshift($label);
                $this->addOption('form-group');
            }

        }
        if ($this->hasHint()) {
            $hint = new Hint();
            $hint->setId($this->getName() . '__hint');
            $this->setAria('describedby', $this->getName() . '__hint');
            $hint->setContent($this->getHint());
            $this->push($hint);
        }
        if ($this->hasError()) {
            $error = new Error();
            $error->setContent($this->getError());
            $error->setId($this->getName() . '__error');
            $this->setAria('describedby', $this->getName() . '__error');
            $this->push($error);
        }
    }

    /**
     * @return bool|null
     */
    public function isFloating(): ?bool
    {
        return $this->floating;
    }

    /**
     * @param bool|null $floating
     */
    public function setFloating(?bool $floating): self
    {
        $this->floating = $floating;
        return $this;
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
        return $this->name !== null;
    }

    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     *
     * @return $this
     */
    public function setHint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasHint(): bool
    {
        return $this->hint !== null;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }

    /**
     * @param string $error
     *
     * @return $this
     */
    public function setError(string $error): self
    {
        $this->error = $error;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->error !== null;
    }

    /**
     * @param Input $input
     */
    public function setInput(Input $input)
    {
        $this->input = $input;
    }

    /***
     * @return bool
     */
    protected function hasInput()
    {
        return isset($this->input);
    }

    /**
     * @return Input|null
     */
    public function getInput()
    {
        return $this->input;
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
