<?php


namespace Pars\Component\Base\Form;


class Radio extends Input
{

    public bool $selected = false;

    protected function initialize()
    {

        $this->setTag('div');
        $this->addOption('form-check');
        $input = new Input();
        $input->fromArray($this->toArray());
        $input->setType(Input::TYPE_RADIO);
        if ($this->hasId()) {
            $id = $this->getId();
            $this->setId($id . '__check');
            $input->setId($id);
        }
        $input->addOption('form-check-input');
        if ($this->isSelected()) {
            $input->setAttribute('checked', 'checked');
        }
        $this->push($input);
        if ($this->hasLabel()) {
            $label = new Label();
            $label->addOption('form-check-label');
            $label->setContent($this->getLabel());
            if ($this->hasId()) {
                $label->setFor($id);
            }
            $this->push($label);
        }
    }

    /**
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected;
    }

    /**
     * @param bool $selected
     * @return Radio
     */
    public function setSelected(bool $selected): Radio
    {
        $this->selected = $selected;
        return $this;
    }


}
