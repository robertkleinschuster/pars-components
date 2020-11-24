<?php


namespace Pars\Component\Base\Form;


class Textarea extends Input
{
    protected function initialize()
    {
        parent::initialize();
        $this->setTag('textarea');
    }

}
