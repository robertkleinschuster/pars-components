<?php


namespace Pars\Component\Base\Form;


use Pars\Bean\Type\Base\BeanInterface;
use Pars\Mvc\View\HtmlElement;

class Checkbox extends Input
{
    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('form-check');
        $input = new Input();
        $input->fromArray($this->toArray());
        $input->setType(Input::TYPE_HIDDEN);
        $input->setValue('false');
        $input->setId($this->getName() . '__default');
        $this->push($input);
        $input = new Input();
        $input->fromArray($this->toArray());
        $input->addOption('form-check-input');
        $input->setType(Input::TYPE_CHECKBOX);
        $input->setValue('true');
        if ($this->getValue() === 'true') {
            $input->setAttribute('checked', 'checked');
        }
        $this->push($input);
        if ($this->hasLabel()) {
            $label = new Label();
            $label->addOption('form-check-label');
            $label->setContent($this->getLabel());
            if ($this->hasName()) {
                $label->setFor($this->getName());
            }
            $this->push($label);
        }
    }

    protected function beforeRenderElement(HtmlElement $element, BeanInterface $bean = null)
    {
        parent::beforeRenderElement($element, $bean);
        if (null !== $bean) {
            $value = $this->replacePlaceholder($this->getValue(), $bean);
            if ($element instanceof Input) {
                if ($value === 'true') {
                    $element->setAttribute('checked', 'checked');
                }
            }
        }
    }


}
