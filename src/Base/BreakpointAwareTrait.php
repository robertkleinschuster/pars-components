<?php


namespace Pars\Component\Base;


trait BreakpointAwareTrait
{
    public ?string $breakpoint = null;

    /**
     * @return string
     */
    public function getBreakpoint(): string
    {
        return $this->breakpoint;
    }

    /**
     * @param string $breakpoint
     *
     * @return $this
     */
    public function setBreakpoint(string $breakpoint)
    {
        $this->breakpoint = $breakpoint;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasBreakpoint(): bool
    {
        return $this->breakpoint !== null;
    }

}
