<?php


namespace Pars\Component\Base\Table;


use Pars\Component\Base\Field\Span;
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
                $span = new Span($field->getLabel());
                if ($field->hasLabelPath()) {
                    $span->setPath($field->getLabelPath());
                }
                $td->setContent($span);
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
