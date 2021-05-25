<?php

namespace Pars\Component\Base\Jumbotron;

use Pars\Component\Base\Field\Paragraph;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Grid\Column;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Grid\Row;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldInterface;
use Pars\Mvc\View\ViewElement;

class Jumbotron extends AbstractComponent
{
    /**
     * @var string|null
     */
    public ?string $heading = null;
    /**
     * @var string|null
     */
    public ?string $lead = null;

    protected function initBase()
    {
        parent::initBase();
        $this->setTag('div');
       # $this->addOption('py-2');
       # $this->addOption('px-2');
       # $this->addOption('mb-4');

        if ($this->hasLead()) {
            $p = new Paragraph($this->getLead());
            $this->addOption('lead');
            $this->getElementList()->unshift($p);
        }
        if ($this->hasHeading()) {
            if ($this->getFieldList()->count()) {
                $this->getElementList()->unshift(new ViewElement('hr.my-4'));
            }
            $h1 = new ViewElement('h1');
            $h1->setContent($this->getHeading());
            $h1->addOption('display-5');
            $this->getElementList()->unshift($h1);
        }
        $container = new Container();
        $container->setMode(Container::MODE_FLUID);
        $arrGroup_Field = [];
        foreach ($this->getFieldList() as $field) {
            if ($field->hasGroup()) {
                $arrGroup_Field[$field->getGroup()][] = $field;
            } else {
                $arrGroup_Field[''][] = $field;
            }
        }
        foreach ($arrGroup_Field as $group => $groupFieldList) {
            if ($group) {
                $title = new Row();
                $title->addOption('fw-bold');
                $title->setContent($group . '<hr>');
                $container->push($title);
                $row = new Row();
                $row->addOption('mb-2');
                // intentionally no break to set breakpoints up to the field count
                $groupFieldCount = count($groupFieldList);
                $groupFieldCount = $groupFieldCount > 4 ? 4: $groupFieldCount;
                switch ($groupFieldCount) {
                    case 4:
                        $row->addOption('row-cols-lg-4');
                    case 3:
                        $row->addOption('row-cols-md-3');
                    case 2:
                        $row->addOption('row-cols-sm-2');
                    case 1:
                        $row->addOption('row-cols-1');
                }
                foreach ($groupFieldList as $field) {
                    $column = new Column();
                    $column->push($this->createFieldRow($field));
                    $row->push($column);
                }
                $container->push($row);
            } else {
                foreach ($groupFieldList as $field) {
                    $row = new Row();
                    $column = new Column();

                    $column->push($this->createFieldRow($field));
                    $row->push($column);
                    $container->push($row);
                }
            }
        }

        $this->push($container);
    }


    /**
     * @param FieldInterface $field
     * @param int $count
     * @return Row
     * @throws \Pars\Bean\Type\Base\BeanException
     */
    protected function createFieldRow(FieldInterface $field): ViewElement
    {
        $div = new ViewElement();
        $block = new ViewElement();
        if ($field->hasLabel()) {
            $label = new ViewElement();
            $span = new Span($field->getLabel());
            $label->addOption('p-2');
            $label->addOption('bg-light');
            $label->addOption('rounded-top');
            $label->addOption('border');
            $label->addOption('border-bottom-0');
            $label->push($span);
            $div->push($label);
            $block->addOption('border');
            $block->addOption('rounded-bottom');
        }
        $block->addOption('mb-1');
        $block->addOption('p-2');
        $block->push($field);
        $div->push($block);
        return $div;
    }

    /**
     * @return string
     */
    public function getLead(): string
    {
        return $this->lead;
    }

    /**
     * @param string $lead
     *
     * @return $this
     */
    public function setLead(string $lead): self
    {
        $this->lead = $lead;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasLead(): bool
    {
        return isset($this->lead);
    }


    /**
     * @return string
     */
    public function getHeading(): string
    {
        return $this->heading;
    }

    /**
     * @param string $heading
     *
     * @return $this
     */
    public function setHeading(string $heading): self
    {
        $this->heading = $heading;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasHeading(): bool
    {
        return isset($this->heading);
    }

}
