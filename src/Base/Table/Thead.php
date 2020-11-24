<?php


namespace Pars\Component\Base\Table;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldListAwareTrait;

class Thead extends AbstractComponent
{
    use FieldListAwareTrait;

    protected function initialize()
    {
        $this->setTag('thead');
        $this->addOption('bg-light');
        $tr = new Tr();
        foreach ($this->getFieldList() as $field) {
            $td = new Td();
            if ($field->hasLabel()) {
                $td->setContent($field->getLabel());
            }
            $tr->push($td);
        }
        $this->push($tr);
    }

}
