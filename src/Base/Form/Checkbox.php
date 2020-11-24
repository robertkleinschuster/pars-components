<?php


namespace Pars\Component\Base\Form;


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

}
