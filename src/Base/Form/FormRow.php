<?php


namespace Pars\Component\Base\Form;


use Pars\Component\Base\Grid\Row;

class FormRow extends Row
{
    protected function initialize()
    {
        parent::initialize();
        $this->addOption('mb-3');
    }
}
