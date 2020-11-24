<?php


namespace Pars\Component\Base;


class Contrast
{
    public function getBackground(string $color)
    {
        switch ($color) {
            case ColorAwareInterface::COLOR_LIGHT:
            case ColorAwareInterface::COLOR_WHITE:
                return BackgroundAwareInterface::BACKGROUND_DARK;
            default:
                return BackgroundAwareInterface::BACKGROUND_LIGHT;
        }
    }

    public function getColor(string $background)
    {
        switch ($background) {
            case BackgroundAwareInterface::BACKGROUND_WHITE:
            case BackgroundAwareInterface::BACKGROUND_TRANSPARENT:
            case BackgroundAwareInterface::BACKGROUND_LIGHT:
                return ColorAwareInterface::COLOR_DARK;
            default:
                return ColorAwareInterface::COLOR_WHITE;
        }
    }
}
