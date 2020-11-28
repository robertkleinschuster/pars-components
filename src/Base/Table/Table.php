<?php


namespace Pars\Component\Base\Table;


use Niceshops\Bean\Type\Base\BeanListAwareInterface;
use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldListAwareTrait;

class Table extends AbstractComponent implements BeanListAwareInterface
{
    use BeanListAwareTrait;
    use FieldListAwareTrait;

    protected function initialize()
    {
        $this->setTag('table');
        $this->addOption('table');
        $this->addOption('table-striped');
        $this->addOption('table-hover');
        $this->addOption('table-bordered');
        $this->addOption('table-sm');
        $this->addOption('mb-0');
        $thead = new Thead();
        $thead->setFieldList($this->getFieldList());
        $this->push($thead);
        $tbody = new Tbody();
        $tbody->setFieldList($this->getFieldList());
        if ($this->hasBeanList()) {
            $tbody->setBeanList($this->getBeanList());
        }
        $this->push($tbody);
    }


}
