<?php


namespace Pars\Component\Base;


interface ColorAwareInterface
{
    public const COLOR_PRIMARY = 'text-primary';
    public const COLOR_SECONDARY = 'text-secondary';
    public const COLOR_SUCCESS = 'text-success';
    public const COLOR_DANGER = 'text-danger';
    public const COLOR_WARNING = 'text-warning';
    public const COLOR_INFO = 'text-info';
    public const COLOR_LIGHT = 'text-light';
    public const COLOR_WHITE = 'text-white';
    public const COLOR_DARK = 'text-dark';

    /**
     * @return string
     */
    public function getColor(): string;

    /**
     * @param string $color
     *
     * @return $this
     */
    public function setColor(string $color);

    /**
     * @return bool
     */
    public function hasColor(): bool;

}
