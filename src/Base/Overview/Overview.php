<?php

namespace Pars\Component\Base\Overview;

use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Component\Base\Table\Table;
use Pars\Mvc\View\AbstractComponent;

class Overview extends AbstractComponent
{
    use BeanListAwareTrait;

    private ?Table $table = null;

    protected function initialize()
    {
        if ($this->hasBeanList()) {
            $this->getTable()->setBeanList($this->getBeanList());
        }
        $this->push($this->getTable());
    }

    /**
     * @return Table|null
     */
    public function getTable(): ?Table
    {
        if (null === $this->table) {
            $this->table = new Table();
        }
        return $this->table;
    }

    /**
     * @param Table|null $table
     * @return Overview
     */
    public function setTable(?Table $table): Overview
    {
        $this->table = $table;
        return $this;
    }

}
