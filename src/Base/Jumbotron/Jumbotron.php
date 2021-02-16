<?php

namespace Pars\Component\Base\Jumbotron;

use Pars\Component\Base\Field\Paragraph;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Grid\Column;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Grid\Row;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldInterface;
use Pars\Mvc\View\FieldListAwareTrait;
use Pars\Mvc\View\HtmlElement;

class Jumbotron extends AbstractComponent
{
    use FieldListAwareTrait;

    /**
     * @var Row[]
     */
    private array $rowMap = [];
    /**
     * @var Column[]
     */
    private array $columnMap = [];


    public ?string $heading = null;
    public ?string $lead = null;

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('jumbotron');
        $this->addOption('rounded-0');
        $this->addOption('py-2');
        $this->addOption('px-2');
        $this->addOption('mb-4');
        $this->addOption('bg-light');
        $this->addOption('shadow-sm');
        if ($this->hasLead()) {
            $p = new Paragraph($this->getLead());
            $this->addOption('lead');
            $this->getElementList()->unshift($p);
        }
        if ($this->hasHeading()) {
            if ($this->getFieldList()->count()) {
                $this->getElementList()->unshift(new HtmlElement('hr.my-4'));
            }
            $h1 = new HtmlElement('h1');
            $h1->setContent($this->getHeading());
            $h1->addOption('display-5');
            $this->getElementList()->unshift($h1);
        }
        $container = new Container();
        $container->setMode(Container::MODE_FLUID);
        ksort($this->columnMap);
        foreach ($this->columnMap as $row => $columns) {
            ksort($columns);
            $formRow = $this->getRow($row);
            $count = count($columns);
            $values = array_values($columns);
            foreach ($values as $index => $column) {
                $column->addOption('p-0');
                if ($index + 1 < $count) {
                    $column->addOption('mr-sm-3');
                }
                $column->push($this->createFieldRow($column->getElementList()->pop(), $count));
                $formRow->push($column);
            }
            $container->push($formRow);
        }

        foreach ($this->getFieldList() as $field) {
            $container->push($this->createFieldRow($field));
        }


        $this->push($container);
    }

    /**
     * @param FieldInterface $field
     * @param int $count
     * @return Row
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    protected function createFieldRow(FieldInterface $field, $count = 1): HtmlElement
    {
        $div = new HtmlElement();
        if ($field->hasLabel()) {
            $span = new Span($field->getLabel());
            $div->push($span);
        }
        $paragraph = new HtmlElement();
        $paragraph->addOption('mb-2');
        $paragraph->addOption('bg-white');
        $paragraph->addOption('border');
        $paragraph->addOption('border-secondary');
        $paragraph->addOption('p-1');
        $paragraph->push($field);
        $div->push($paragraph);
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

    /**
     * @param FieldInterface $field
     * @param int|null $row
     * @param int|null $column
     * @return Jumbotron
     */
    public function append(FieldInterface $field, ?int $row = null, ?int $column = null): self
    {
        if ($row !== null || $column !== null) {
            $col = $this->getColumn($row ?? 1, $column ?? 1);
            $col->push($field);
            $col->setBreakpoint(Column::BREAKPOINT_SMALL);
        } else {
            $this->getFieldList()->push($field);
        }
        return $this;
    }


    /**
     * @param int $row
     * @return mixed|Row
     */
    protected function getRow(int $row)
    {
        if (!isset($this->rowMap[$row])) {
            $this->rowMap[$row] = new Row();
        }
        return $this->rowMap[$row];
    }

    /**
     * @param int $row
     * @param int $column
     * @return mixed
     */
    protected function getColumn(int $row, int $column)
    {
        if (!isset($this->columnMap[$row][$column])) {
            $this->columnMap[$row][$column] = new Column();
        }
        return $this->columnMap[$row][$column];
    }

}
