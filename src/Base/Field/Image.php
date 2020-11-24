<?php


namespace Pars\Component\Base\Field;


use Niceshops\Core\Mode\ModeAwareInterface;
use Niceshops\Core\Mode\ModeAwareTrait;
use Pars\Mvc\View\AbstractField;

class Image extends AbstractField implements ModeAwareInterface
{
    use ModeAwareTrait;

    public const MODE_BACKGROUND = 'background';
    public const HIDE_TEXT = 'text-hide';

    /**
     * @var string|null
     */
    public ?string $source = null;

    /**
     * Image constructor.
     * @param string|null $source
     */
    public function __construct(?string $source = null)
    {
        parent::__construct();
        $this->source = $source;
    }


    protected function initialize()
    {
        if ($this->hasMode() && $this->getMode() == self::MODE_BACKGROUND) {
            $this->setAttribute('style', 'background-image: url(' . $this->getSource() . ');');
        } else {
            $this->setTag('img');
            $this->addOption('img-fluid');
            if ($this->hasLabel()) {
                $this->setAttribute('alt', $this->getLabel());
            }
            if ($this->hasSource()) {
                $this->setAttribute('src', $this->getSource());
            }
        }
    }

    /**
     * @param bool $hide
     * @return $this
     */
    public function hideText(bool $hide = true): self
    {
        if ($hide) {
            $this->addOption(self::HIDE_TEXT);
        } else {
            $this->removeOption(self::HIDE_TEXT);
        }
        return $this;
    }

    /**
     * @param bool $background
     */
    public function setAsBackground(bool $background = true)
    {
        if ($background) {
            $this->setMode(self::MODE_BACKGROUND);
        } else {
            $this->setMode('');
        }
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
