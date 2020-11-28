<?php


namespace Pars\Component\Base\Table;


use Niceshops\Bean\Type\Base\BeanListAwareInterface;
use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class TableResponsive extends AbstractComponent implements BeanListAwareInterface
{
    use BeanListAwareTrait;

    public ?Table $table = null;

    protected function initialize()
    {
        $this->setTag('div');
        $this->addOption('shadow-sm');
        $this->addOption('table-responsive');
        $this->addOption('mb-4');
        if ($this->hasBeanList()) {
            $this->getTable()->setBeanList($this->getBeanList());
        }
        $this->push($this->getTable());
    }

    /**
     * @return Table|null
     */
    public function getTable(): Table
    {
        if (null === $this->table) {
            $this->table = new Table();
        }
        return $this->table;
    }

    /**
     * @param Table|null $table
     * @return TableResponsive
     */
    public function setTable(?Table $table): TableResponsive
    {
        $this->table = $table;
        return $this;
    }



}
