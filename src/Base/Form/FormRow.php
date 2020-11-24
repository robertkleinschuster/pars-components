<?php


namespace Pars\Component\Base\Form;


use Pars\Component\Base\Grid\Row;

class FormRow extends Row
{
    protected function initialize()
    {
        $this->removeOption('row');
        $this->addOption('form-row');
    }
}
