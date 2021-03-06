<?php

namespace Pars\Component\Base\Detail;

use Pars\Bean\Type\Base\BeanAwareInterface;
use Pars\Bean\Type\Base\BeanAwareTrait;
use Pars\Bean\Type\Base\BeanException;
use Pars\Component\Base\Collapsable\Collapsable;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Jumbotron\Jumbotron;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldAcceptInterface;
use Pars\Mvc\View\FieldInterface;

class Detail extends AbstractComponent implements BeanAwareInterface
{
    use BeanAwareTrait;

    protected ?Jumbotron $jumbotron = null;
    protected ?Collapsable $collapsable = null;
    protected ?FieldAcceptInterface $showEditAccept = null;

    protected function handleFields()
    {
        parent::handleFields();
        foreach ($this->getFieldList() as $field) {
            $this->getJumbotron()->pushField($field);
        }
        if ($this->hasCollapsable()) {
            $this->getCollapsable()->pushComponent($this->getJumbotron());
            $this->getMain()->push($this->getCollapsable());
        } else {
            $this->getMain()->push($this->getJumbotron());
        }
    }


    /**
     * @return Jumbotron|null
     */
    public function getJumbotron(): ?Jumbotron
    {
        if (null === $this->jumbotron) {
            $this->jumbotron = new Jumbotron();
        }
        return $this->jumbotron;
    }

    /**
     * @param Jumbotron|null $jumbotron
     * @return Detail
     */
    public function setJumbotron(?Jumbotron $jumbotron): self
    {
        $this->jumbotron = $jumbotron;
        return $this;
    }

    /**
     * @param string $name
     * @param string $label
     * @param int|null $row
     * @param int|null $col
     * @return Span
     * @throws BeanException
     */
    public function addSpan(string $name, string $label, int $row = null, int $col = null): Span
    {
        $span = new Span("{{$name}}", $label);
        $this->pushField($span, $row, $col);
        return $span;
    }

    /**
     * @param string $heading
     */
    public function setHeading(string $heading)
    {
        $this->getJumbotron()->setHeading($heading);
    }

    /**
     * @param FieldInterface $field
     * @param int|null $row
     * @param int|null $column
     * @return $this
     */
    public function pushField(FieldInterface $field, int $row = null, int $column = null): self
    {
        $field->setRow($row);
        $field->setColumn($column);
        return parent::pushField($field);
    }

    /**
     * @return FieldAcceptInterface
     */
    public function getShowEditFieldAccept(): FieldAcceptInterface
    {
        return $this->showEditAccept;
    }

    /**
     * @param FieldAcceptInterface $showEditAccept
     *
     * @return $this
     */
    public function setShowEditFieldAccept(FieldAcceptInterface $showEditAccept): self
    {
        $this->showEditAccept = $showEditAccept;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasShowEditFieldAccept(): bool
    {
        return isset($this->showEditAccept);
    }

    /**
     * @return Collapsable
     */
    public function getCollapsable(): Collapsable
    {
        return $this->collapsable;
    }

    /**
     * @param Collapsable $collapsable
     *
     * @return $this
     */
    public function setCollapsable(Collapsable $collapsable): self
    {
        $this->collapsable = $collapsable;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCollapsable(): bool
    {
        return isset($this->collapsable);
    }


}
