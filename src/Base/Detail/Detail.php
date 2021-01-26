<?php

namespace Pars\Component\Base\Detail;

use Niceshops\Bean\Type\Base\BeanAwareInterface;
use Niceshops\Bean\Type\Base\BeanAwareTrait;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Jumbotron\Jumbotron;
use Pars\Component\Base\Toolbar\Toolbar;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldInterface;

class Detail extends AbstractComponent implements BeanAwareInterface
{
    use BeanAwareTrait;

    private ?Jumbotron $jumbotron = null;
    protected ?Toolbar $toolbar = null;
    protected ?Toolbar $subToolbar = null;

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
    public function setJumbotron(?Jumbotron $jumbotron): Detail
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
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    public function addField(string $name, string $label, int $row = null, int $col = null)
    {
        $span = new Span("{{$name}}", $label);
        $this->getJumbotron()->append($span, $row, $col);
        return $span;
    }

    /**
     * @param string $headline
     */
    public function setHeadline(string $headline)
    {
        $this->getJumbotron()->setHeadline($headline);
    }

    /**
     * @param FieldInterface $field
     * @param int|null $row
     * @param int|null $column
     * @return $this
     */
    public function append(FieldInterface $field, int $row = null, int $column = null)
    {
        $this->getJumbotron()->append($field, $row, $column);
        return $this;
    }

    /**
     * @param FieldInterface $field
     * @return $this
     */
    public function prepend(FieldInterface $field)
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

}
