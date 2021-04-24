<?php


namespace Pars\Component\Base\Toolbar;


class BulkButton extends ToolbarButton
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
        $this->addOption('bulk-button');
        parent::initialize();
    }

}
