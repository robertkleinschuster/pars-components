<?php


namespace Pars\Component\Base\Form;


use Pars\Component\Base\Grid\Column;

class FormColumn extends Column
{
    protected function initBase()
    {
        parent::initBase();
        $this->addOption('mb-2');
    }

}
