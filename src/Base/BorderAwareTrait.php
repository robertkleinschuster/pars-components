<?php


namespace Pars\Component\Base;


trait BorderAwareTrait
{
    public ?string $border = null;
    public ?string $borderPosition = null;
    public ?string $rounded = null;

    /**
    * @return string
    */
    public function getBorder(): string
    {
        return $this->border;
    }

    /**
    * @param string $border
    *
    * @return $this
    */
    public function setBorder(string $border)
    {
        $this->border = $border;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasBorder(): bool
    {
        return $this->border !== null;
    }
    /**
    * @return string
    */
    public function getBorderPosition(): string
    {
        return $this->borderPosition;
    }

    /**
    * @param string $borderPosition
    *
    * @return $this
    */
    public function setBorderPosition(string $borderPosition)
    {
        $this->borderPosition = $borderPosition;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasBorderPosition(): bool
    {
        return $this->borderPosition !== null;
    }
    /**
    * @return string
    */
    public function getRounded(): string
    {
        return $this->rounded;
    }

    /**
    * @param string $rounded
    *
    * @return $this
    */
    public function setRounded(string $rounded)
    {
        $this->rounded = $rounded;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasRounded(): bool
    {
        return $this->rounded !== null;
    }

}
