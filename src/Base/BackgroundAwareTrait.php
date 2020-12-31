<?php


namespace Pars\Component\Base;


trait BackgroundAwareTrait
{

    public ?string $background = null;

    /**
     * @return string
     */
    public function getBackground(): string
    {
        return $this->background;
    }

    /**
     * @param string $background
     *
     * @return $this
     */
    public function setBackground(string $background)
    {
        $this->background = $background;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasBackground(): bool
    {
        return $this->background !== null;
    }

}
