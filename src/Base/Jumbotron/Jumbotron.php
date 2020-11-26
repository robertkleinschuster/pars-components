<?php

namespace Pars\Component\Base\Jumbotron;

use Pars\Component\Base\Field\Paragraph;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Grid\Column;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Grid\Row;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldListAwareTrait;
use Pars\Mvc\View\HtmlElement;

class Jumbotron extends AbstractComponent
{
    use FieldListAwareTrait;

    public ?string $headline = null;
    public ?string $lead = null;

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('jumbotron');
        $this->getElementList()->unshift(new HtmlElement('hr.my-4'));
        if ($this->hasLead()) {
            $p = new Paragraph($this->getLead());
            $this->addOption('lead');
            $this->getElementList()->unshift($p);
        }
        if ($this->hasHeadline()) {
            $h1 = new HtmlElement('h1');
            $h1->setContent($this->getHeadline());
            $h1->addOption('display-5');
            $this->getElementList()->unshift($h1);
        }
        $container = new Container();
        foreach ($this->getFieldList() as $field) {
            $row = new Row();
            $row->addOption('mb-2');
            $col = new Column();
            $col->addOption('pl-0');
            $col->setBreakpoint(Column::BREAKPOINT_SMALL);
            if ($field->hasLabel()) {
                $span = new Span($field->getLabel());
                $col->push($span);
            }
            $row->push($col);
            $col = new Column();
            $col->setBreakpoint(Column::BREAKPOINT_SMALL);
            $col->setBackground(Column::BACKGROUND_LIGHT);
            $col->setBorder(Column::BORDER_SECONDARY);
            $col->setRounded(Column::ROUNDED_DEFAULT);
            $col->push($field);
            $row->push($col);
            $container->push($row);
        }
        $this->push($container);
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
    public function getHeadline(): string
    {
        return $this->headline;
    }

    /**
    * @param string $headline
    *
    * @return $this
    */
    public function setHeadline(string $headline): self
    {
        $this->headline = $headline;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasHeadline(): bool
    {
        return isset($this->headline);
    }


}