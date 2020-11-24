<?php


namespace Pars\Component\Base\Form;


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
