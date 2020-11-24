<?php


namespace Pars\Component\Base\Form;


class RadioGroup extends Select
{
    protected function initialize()
    {
        if ($this->hasName()) {
            $name = $this->getName();
            $this->setId($name);
            $this->setName($this->getName() . '__group');
        }
        if ($this->hasOption('is-invalid')) {
            $this->setBorder(self::BORDER_DANGER);
            $this->setRounded(self::ROUNDED_DEFAULT);
        }
        parent::initialize();
        $this->setTag('fieldset');
        $this->removeOption('form-control');
        $this->getElementList()->clear();
        if ($this->hasOptions()) {
            foreach ($this->getOptions() as $value => $label) {
                $radio = new Radio();
                $radio->setLabel($label);
                $radio->setValue($value);
                if ($this->hasValue() && $this->getValue() === $value) {
                    $radio->setSelected(true);
                }
                if ($this->hasName()) {
                    $radio->setName($name);
                    $radio->setId($name . '__' . $value);
                } else {
                    $radio->setId($value);
                }
                $this->push($radio);
            }
        }
    }

}
