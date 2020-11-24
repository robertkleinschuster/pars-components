<?php

declare(strict_types=1);

namespace Pars\Component\Base;

/**
 * Interface LinkAwareInterface
 * @package Pars\Component\Components\Base
 */
interface TargetAwareInterface
{
    public const TARGET_BLANK = '_blank';
    public const TARGET_SELF = '_self';
    public const TARGET_PARENT = '_parent';
    public const TARGET_TOP = '_top';

    /**
     * @return string
     */
    public function getTarget(): string;

    /**
     * @param string $target
     *
     * @return $this
     */
    public function setTarget(string $target);

    /**
     * @return bool
     */
    public function hasTarget(): bool;


}
