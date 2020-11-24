<?php

declare(strict_types=1);

namespace Pars\Component\Base\Alert;


use Pars\Component\Base\Field\Paragraph;
use Pars\Component\Base\StyleAwareInterface;
use Pars\Component\Base\StyleAwareTrait;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElement;

/**
 * Class Alert
 * @package Pars\Component\Components\Alert
 */
class Alert extends AbstractComponent implements StyleAwareInterface
{
    use StyleAwareTrait;

    /**
     * @var string
     */
    private ?string $heading = null;

    /**
     * Alert constructor.
     * @param string|null $heading
     * @param string|null $content
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    public function __construct(?string $heading = null, ?string $content = null)
    {
        parent::__construct();
        $this->heading = $heading;
        $this->content = $content;
    }


    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('alert');
        if ($this->hasStyle()) {
            $this->addOption('alert-' . $this->getStyle());
        } else {
            $this->addOption('alert-' . self::STYLE_DANGER);
        }
        $this->setRole('alert');
        if ($this->hasHeading()) {
            $heading = new HtmlElement('h4');
            $heading->setContent($this->getHeading());
            $this->getElementList()->push($heading);
        }
    }


    /**
     * @param string $value
     * @return Paragraph
     */
    public function addParagraph(string $value): Paragraph
    {
        $paragraph = new Paragraph();
        $paragraph->setContent($value);
        $this->getMainFieldList()->push($paragraph);
        return $paragraph;
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
        return $this->heading !== null;
    }
}
