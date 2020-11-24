<?php

declare(strict_types=1);

namespace Pars\Component\Base;

/**
 * Interface IconAwareInterface
 * @package Pars\Component\Components\Base
 */
interface IconAwareInterface
{

    /**
     * @return string
     */
    public function getIcon(): string;

    /**
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon(string $icon);

    /**
     * @return bool
     */
    public function hasIcon(): bool;
}
