<?php


namespace Pars\Component\Base;


interface BreakpointAwareInterface
{
    public const BREAKPOINT_SMALL = 'sm';
    public const BREAKPOINT_MEDIUM = 'md';
    public const BREAKPOINT_LARGE = 'lg';
    public const BREAKPOINT_EXTRA_LARGE = 'xl';

    /**
     * @return string
     */
    public function getBreakpoint(): string;

    /**
     * @param string $breakpoint
     *
     * @return $this
     */
    public function setBreakpoint(string $breakpoint);

    /**
     * @return bool
     */
    public function hasBreakpoint(): bool;
}
