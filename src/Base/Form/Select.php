<?php


namespace Pars\Component\Base\Form;


use Pars\Bean\Type\Base\BeanInterface;
use Pars\Mvc\View\ViewElement;

class Select extends Input
{
    public ?array $options = null;

    public function __construct(array $options = null)
    {
        parent::__construct();
        $this->options = $options;
    }


    /**
     * @return mixed|void
     * @throws \Pars\Pattern\Exception\AttributeExistsException
     * @throws \Pars\Pattern\Exception\AttributeLockException
     */
    protected function initialize()
    {
        parent::initialize();
        $this->setTag('select');
        $this->addOption('form-select');
        if ($this->hasOptions()) {
            foreach ($this->getOptions() as $value => $label) {
                $option = new ViewElement('option');
                $option->setAttribute('value', $value);
                $option->setContent($label);
                $this->push($option);
            }
        }
    }

    protected $replacedValue = null;

    protected function beforeRenderElement(ViewElement $element, BeanInterface $bean = null)
    {
        parent::beforeRenderElement($element, $bean);
        if ($element->hasAttribute('value') && $bean !== null) {
            if (null === $this->replacedValue) {
                $this->replacedValue = $this->replacePlaceholder($this->getValue(), $bean);
            }
            if ($element->getAttribute('value') == $this->replacedValue && !empty($this->replacedValue)) {
                $element->setAttribute('selected', 'selected');
                $element->setAttribute('checked', 'checked');
            }
        }
    }


    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions(array $options): self
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasOptions(): bool
    {
        return $this->options !== null;
    }


}
