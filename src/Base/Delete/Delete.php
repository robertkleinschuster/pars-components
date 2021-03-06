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

    protected function initAdditionalBefore()
    {
        if ($this->hasHeading()) {
            $alert = new Alert($this->getHeading());
            $alert->setStyle(Alert::STYLE_DANGER);
            if ($this->hasText()) {
                $alert->addBlock($this->getText());
            }
            $this->getBefore()->push($alert);
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
