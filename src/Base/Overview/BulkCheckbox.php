<?php


namespace Pars\Component\Base\Overview;


use Pars\Component\Base\Form\Input;

class BulkCheckbox extends Input
{
    protected function initialize()
    {
        $this->setType(self::TYPE_CHECKBOX);
        parent::initialize();
    }

}
