<?php


namespace Pars\Component\Base;


trait ContrastTrait
{
    public function getContrast(): Contrast
    {
        return new Contrast();
    }
}
