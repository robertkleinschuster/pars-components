<?php


namespace Pars\Component\Base\Field;


use Pars\Component\Base\TextAwareInterface;
use Pars\Component\Base\TextAwareTrait;
use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\ViewElement;

class Blockquote extends AbstractField implements TextAwareInterface
{
    use TextAwareTrait;

    /**
     * @var string
     */
    private ?string $footer = null;

    /**
     * @var string
     */
    private ?string $cite = null;

    public function __construct(?string $text = null, ?string $cite = null, ?string $footer = null)
    {
        parent::__construct();
        $this->text = $text;
        $this->cite = $cite;
        $this->footer = $footer;
    }


    /**
     * @return mixed|void
     */
    protected function initialize()
    {
        $this->setTag('blockquote');
        $this->addOption('blockquote');
        if ($this->hasText()) {
            $p = new ViewElement('p');
            $p->addOption('mb-0');
            $p->setContent($this->getText());
            $this->push($p);
        }
        if ($this->hasFooter()) {
            $footer = new ViewElement('footer');
            $footer->setContent($this->getFooter());
            if ($this->hasCite()) {
                $cite = new ViewElement('cite');
                $cite->setContent($this->getCite());
                $footer->push($cite);
            }
            $this->push($footer);
        }
    }

    /**
     * @return string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * @param string $footer
     *
     * @return $this
     */
    public function setFooter(string $footer): self
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasFooter(): bool
    {
        return $this->footer !== null;
    }

    /**
     * @return string
     */
    public function getCite(): string
    {
        return $this->cite;
    }

    /**
     * @param string $cite
     *
     * @return $this
     */
    public function setCite(string $cite): self
    {
        $this->cite = $cite;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCite(): bool
    {
        return $this->cite !== null;
    }
}
