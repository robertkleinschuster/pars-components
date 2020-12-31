<?php


namespace Pars\Component\Base;


interface BackgroundAwareInterface
{
    public const BACKGROUND_PRIMARY = 'bg-primary';
    public const BACKGROUND_SECONDARY = 'bg-secondary';
    public const BACKGROUND_SUCCESS = 'bg-success';
    public const BACKGROUND_DANGER = 'bg-danger';
    public const BACKGROUND_WARNING = 'bg-warning';
    public const BACKGROUND_INFO = 'bg-info';
    public const BACKGROUND_LIGHT = 'bg-light';
    public const BACKGROUND_WHITE = 'bg-white';
    public const BACKGROUND_TRANSPARENT = 'bg-transparent';
    public const BACKGROUND_DARK = 'bg-dark';

    /**
     * @return string
     */
    public function getBackground(): string;

    /**
     * @param string $background
     *
     * @return $this
     */
    public function setBackground(string $background);

    /**
     * @return bool
     */
    public function hasBackground(): bool;

}
