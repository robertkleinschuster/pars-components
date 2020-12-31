<?php

namespace Pars\Component\Base\Detail;

use Niceshops\Bean\Type\Base\BeanAwareInterface;
use Niceshops\Bean\Type\Base\BeanAwareTrait;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Jumbotron\Jumbotron;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldInterface;
use Pars\Mvc\View\HtmlElement;

class Detail extends AbstractComponent implements BeanAwareInterface
{
    use BeanAwareTrait;

    private ?Jumbotron $jumbotron = null;

    protected function initialize()
    {
        if ($this->hasSection()) {
            $this->getElementList()->unshift(new HtmlElement('h3.mb-3', $this->getSection()));
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
     * @return Span
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    public function addField(string $name, string $label)
    {
        $span = new Span("{{$name}}", $label);
        $this->getJumbotron()->getFieldList()->push($span);
        return $span;
    }


    public function setHeadline(string $headline)
    {
        $this->getJumbotron()->setHeadline($headline);
    }

    public function append(FieldInterface $field)
    {
        $this->getJumbotron()->getFieldList()->push($field);
        return $this;
    }

    public function prepend(FieldInterface $field)
    {
        $this->getJumbotron()->getFieldList()->push($field);
        return $this;
    }

    public ?string $section = null;

    /**
     * @return string
     */
    public function getSection(): string
    {
        return $this->section;
    }

    /**
     * @param string $section
     *
     * @return $this
     */
    public function setSection(string $section): self
    {
        $this->section = $section;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSection(): bool
    {
        return isset($this->section);
    }
}
