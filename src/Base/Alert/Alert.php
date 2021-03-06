<?php

declare(strict_types=1);

namespace Pars\Component\Base\Alert;


use Pars\Component\Base\Field\Codeblock;
use Pars\Component\Base\Field\Paragraph;
use Pars\Component\Base\StyleAwareInterface;
use Pars\Component\Base\StyleAwareTrait;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ViewElement;

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
     * @param string|null $text
     * @throws \Pars\Bean\Type\Base\BeanException
     */
    public function __construct(?string $heading = null, ?string $text = null)
    {
        parent::__construct();
        $this->heading = $heading;
        if (null !== $text) {
            $this->addBlock($text);
        }
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
            $heading = new ViewElement('h4');
            $heading->setContent($this->getHeading());
            $this->getElementList()->unshift($heading);
        }
    }


    /**
     * @param string $value
     * @return Paragraph
     */
    public function addBlock(?string $value): Paragraph
    {
        $block = new Paragraph();
        $block->addOption('mb-0');
        $block->setContent($value);
        $this->getElementList()->push($block);
        return $block;
    }

    /**
     * @param string $value
     * @return Paragraph
     */
    public function addCodeblock(?string $value): Codeblock
    {
        $block = new Codeblock();
        $block->setContent($value);
        $this->getElementList()->push($block);
        return $block;
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
