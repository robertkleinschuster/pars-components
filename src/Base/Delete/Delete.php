<?php
namespace Pars\Component\Base\Delete;

use Pars\Component\Base\Alert\Alert;
use Pars\Component\Base\TextAwareInterface;
use Pars\Component\Base\TextAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class Delete extends AbstractComponent implements TextAwareInterface
{
    use TextAwareTrait;

    public ?string $heading = null;

    protected function initialize()
    {
        if ($this->hasHeading()) {
            $alert = new Alert($this->getHeading());
            if ($this->hasText()) {
                $alert->addParagraph($this->getText());
            }
            $this->getElementList()->unshift($alert);
        }
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
        return isset($this->heading);
    }

}
