<?php


namespace Pars\Component\Base\Form;


use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Mvc\View\HtmlElement;

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
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     */
    protected function initialize()
    {
        parent::initialize();
        $this->setTag('select');
        if ($this->hasOptions()) {
            foreach ($this->getOptions() as $value => $label) {
                $option = new HtmlElement('option');
                $option->setAttribute('value', $value);
                $option->setContent($label);
                $this->push($option);
            }
        }
    }

    protected $replaedValue = null;

    protected function beforeRenderElement(HtmlElement $element, BeanInterface $bean = null)
    {
        parent::beforeRenderElement($element, $bean);
        if ($element->hasAttribute('value') && $bean !== null) {
            if (null == $this->replaedValue) {
                $this->replaedValue =  $this->replacePlaceholder($this->getValue(), $bean);
            }
            if ($element->getAttribute('value') == $this->replaedValue) {
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
