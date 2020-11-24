<?php


namespace Pars\Component\Base;


trait StyleAwareTrait
{
    private ?string $style = null;

    /**
    * @return string
    */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
    * @param string $style
    *
    * @return $this
    */
    public function setStyle(string $style)
    {
        $this->style = $style;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasStyle(): bool
    {
        return isset($this->style);
    }
}
