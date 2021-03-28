<?php

namespace Pars\Component\Base\Detail;

use Niceshops\Bean\Type\Base\BeanAwareInterface;
use Niceshops\Bean\Type\Base\BeanAwareTrait;
use Niceshops\Bean\Type\Base\BeanException;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Jumbotron\Jumbotron;
use Pars\Component\Base\Toolbar\Toolbar;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldAcceptInterface;
use Pars\Mvc\View\FieldInterface;

class Detail extends AbstractComponent implements BeanAwareInterface
{
    use BeanAwareTrait;

    private ?Jumbotron $jumbotron = null;
    protected ?Toolbar $toolbar = null;
    protected ?Toolbar $subToolbar = null;
    public ?FieldAcceptInterface $showEditAccept = null;

    protected function initialize()
    {
        if ($this->getToolbar()->getElementList()->count()) {
            $this->push($this->getToolbar());
        }
        if ($this->getSubToolbar()->getElementList()->count()) {
            $this->push($this->getSubToolbar());
        }
        $this->push($this->getJumbotron());
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
    public function addField(string $name, string $label, int $row = null, int $col = null): Span
    {
        $span = new Span("{{$name}}", $label);
        $this->getJumbotron()->append($span, $row, $col);
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
    public function append(FieldInterface $field, int $row = null, int $column = null): self
    {
        $this->getJumbotron()->append($field, $row, $column);
        return $this;
    }

    /**
     * @param FieldInterface $field
     * @return $this
     */
    public function prepend(FieldInterface $field): Detail
    {
        $this->getJumbotron()->getFieldList()->unshift($field);
        return $this;
    }

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->getName();
    }

    /**
     * @param string $section
     *
     * @return $this
     */
    public function setSection(string $section): self
    {
        return $this->setName($section);
    }

    /**
     * @return bool
     */
    public function hasSection(): bool
    {
        return $this->hasName();
    }


    /**
     * @return Toolbar|null
     */
    public function getToolbar(): ?Toolbar
    {
        if (null == $this->toolbar) {
            $this->toolbar = new Toolbar();
        }
        return $this->toolbar;
    }

    /**
     * @param Toolbar|null $toolbar
     */
    public function setToolbar(?Toolbar $toolbar): void
    {
        $this->toolbar = $toolbar;
    }

    /**
     * @return Toolbar|null
     */
    public function getSubToolbar(): ?Toolbar
    {
        if (null == $this->subToolbar) {
            $this->subToolbar = new Toolbar();
        }
        return $this->subToolbar;
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

}
