<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Button;

class BulkButton extends Button
{
    public function __construct(string $name, string $value)
    {
        parent::__construct();
        $this->setName($name);
        $this->setValue($value);
    }


    protected function initialize()
    {
        $this->setType('submit');
        parent::initialize();
    }

}
