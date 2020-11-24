<?php


namespace Pars\Component\Base\Table;


use Niceshops\Bean\Type\Base\BeanListAwareInterface;
use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class TableResponsive extends AbstractComponent implements BeanListAwareInterface
{
    use BeanListAwareTrait;

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('table-responsive');
        $table = new Table();
        if ($this->hasBeanList()) {
            $table->setBeanList($this->getBeanList());
        }
        $this->push($table);
    }

}
