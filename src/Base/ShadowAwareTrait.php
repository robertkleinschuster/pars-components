<?php


namespace Pars\Component\Base;


trait ShadowAwareTrait
{
    protected ?string $shadow = null;

    /**
     * @return string
     */
    public function getShadow(): string
    {
        return $this->shadow;
    }

    /**
     * @param string $shadow
     *
     * @return $this
     */
    public function setShadow(string $shadow)
    {
        $this->shadow = $shadow;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasShadow(): bool
    {
        return $this->shadow !== null;
    }

}
