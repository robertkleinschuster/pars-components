<?php


namespace Pars\Component\Base\Table;


use Pars\Mvc\View\AbstractComponent;

class Td extends AbstractComponent
{
    protected function initialize()
    {
        $this->setTag('td');
        $this->addOption('align-middle');
    }

}
