<?php

declare(strict_types=1);

namespace Pars\Component\Base;

/**
 * Trait LinkAwareTrait
 * @package Pars\Component\Components\Base
 */
trait TargetAwareTrait
{
    /**
     * @var string
     */
    private ?string $target = null;

    /**
     * @return string
     */
    public function getTarget(): string
    {
        return $this->target;
    }

    /**
     * @param string $target
     *
     * @return $this
     */
    public function setTarget(string $target)
    {
        $this->target = $target;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasTarget(): bool
    {
        return $this->target !== null;
    }
}
