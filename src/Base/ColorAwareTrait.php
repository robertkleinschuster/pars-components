<?php


namespace Pars\Component\Base;


trait ColorAwareTrait
{
    public ?string $color = null;

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     *
     * @return $this
     */
    public function setColor(string $color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasColor(): bool
    {
        return $this->color !== null;
    }

}
