<?php


namespace Pars\Component\Base\Table;


use Pars\Component\Base\Overview\BulkCheckbox;
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
            if ($field instanceof BulkCheckbox) {
                $selectAll = new BulkCheckbox();
                $selectAll->addOption('bulk-all');
                $selectAll->setData('name', $field->getName());
                $td->push($selectAll);
            }
            $tr->push($td);
        }
        $this->push($tr);
    }

}
