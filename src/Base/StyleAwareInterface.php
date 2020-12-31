<?php


namespace Pars\Component\Base;


interface StyleAwareInterface
{
    public const STYLE_PRIMARY = 'primary';
    public const STYLE_SECONDARY = 'secondary';
    public const STYLE_SUCCESS = 'success';
    public const STYLE_DANGER = 'danger';
    public const STYLE_WARNING = 'warning';
    public const STYLE_INFO = 'info';
    public const STYLE_LIGHT = 'light';
    public const STYLE_DARK = 'dark';

    public function getStyle(): string;

    /**
     * @param string $style
     *
     * @return $this
     */
    public function setStyle(string $style);

    /**
     * @return bool
     */
    public function hasStyle(): bool;
}
