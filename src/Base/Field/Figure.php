<?php


namespace Pars\Component\Base\Field;


use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\ViewElement;

class Figure extends AbstractField
{
    public ?string $source = null;

    /**
     * Figure constructor.
     * @param string|null $source
     */
    public function __construct(?string $source = null, ?string $content = null)
    {
        parent::__construct($content);
        $this->source = $source;
    }


    protected function initialize()
    {
        $this->setTag('figure');
        $this->addOption('figure');
        $image = new Image($this->getSource());
        $this->push($image);
        $figcaption = new ViewElement('figcaption');
        $figcaption->addOption('figure-caption');
        if ($this->hasContent()) {
            $figcaption->setContent($this->getContent());
        }
        $this->push($figcaption);
        $this->setContent('');
    }

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @param string $source
     *
     * @return $this
     */
    public function setSource(string $source): self
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSource(): bool
    {
        return $this->source !== null;
    }

}
