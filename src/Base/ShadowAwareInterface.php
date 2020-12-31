<?php


namespace Pars\Component\Base;


interface ShadowAwareInterface
{
    public const SHADOW_DEFAULT = 'shadow';
    public const SHADOW_NONE = 'shadow-none';
    public const SHADOW_SMALL = 'shadow-sm';
    public const SHADOW_LARGE = 'shadow-lg';


    /**
     * @return string
     */
    public function getShadow(): string;

    /**
     * @param string $shadow
     *
     * @return $this
     */
    public function setShadow(string $shadow);

    /**
     * @return bool
     */
    public function hasShadow(): bool;
}
