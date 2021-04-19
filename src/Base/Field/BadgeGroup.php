<?php


namespace Pars\Component\Base\Field;


use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\FieldListAwareTrait;

class BadgeGroup extends AbstractField
{
    use FieldListAwareTrait;

    protected function initialize()
    {
        foreach ($this->getFieldList() as $field) {
            $field->addOption('me-1');
            $this->push($field);
        }
    }

    public function append(Badge $badge)
    {
        $this->getFieldList()->push($badge);
        return $this;
    }

    public function prepend(Badge $badge)
    {
        $this->getFieldList()->unshift($badge);
        return $this;
    }
}
