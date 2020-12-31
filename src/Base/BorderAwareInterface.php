<?php


namespace Pars\Component\Base;


interface BorderAwareInterface
{
    public const BORDER_PRIMARY = 'border-primary';
    public const BORDER_SECONDARY = 'border-secondary';
    public const BORDER_SUCCESS = 'border-success';
    public const BORDER_DANGER = 'border-danger';
    public const BORDER_WARNING = 'border-warning';
    public const BORDER_INFO = 'border-info';
    public const BORDER_LIGHT = 'border-light';
    public const BORDER_DARK = 'border-dark';

    public const BORDER_POSITION_TOP = 'border-top';
    public const BORDER_POSITION_RIGHT = 'border-right';
    public const BORDER_POSITION_BOTTOM = 'border-bottom';
    public const BORDER_POSITION_LEFT = 'border-left';

    public const ROUNDED_NONE = 'rounded-0';
    public const ROUNDED_DEFAULT = 'rounded';
    public const ROUNDED_SMALL = 'rounded-sm';
    public const ROUNDED_LARGE = 'rounded-lg';
    public const ROUNDED_TOP = 'rounded-top';
    public const ROUNDED_RIGHT = 'rounded-right';
    public const ROUNDED_BOTTOM = 'rounded-bottom';
    public const ROUNDED_LEFT = 'rounded-left';
    public const ROUNDED_CERCLE = 'rounded-cercle';
    public const ROUNDED_PILL = 'rounded-pill';


    /**
     * @return string
     */
    public function getBorder(): string;

    /**
     * @param string $border
     *
     * @return $this
     */
    public function setBorder(string $border);

    /**
     * @return bool
     */
    public function hasBorder(): bool;

    /**
     * @return string
     */
    public function getBorderPosition(): string;

    /**
     * @param string $borderPosition
     *
     * @return $this
     */
    public function setBorderPosition(string $borderPosition);

    /**
     * @return bool
     */
    public function hasBorderPosition(): bool;

    /**
     * @return string
     */
    public function getRounded(): string;

    /**
     * @param string $rounded
     *
     * @return $this
     */
    public function setRounded(string $rounded);

    /**
     * @return bool
     */
    public function hasRounded(): bool;
}
