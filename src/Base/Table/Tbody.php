<?php


namespace Pars\Component\Base\Table;


use Pars\Bean\Type\Base\BeanInterface;
use Pars\Bean\Type\Base\BeanListAwareInterface;
use Pars\Bean\Type\Base\BeanListAwareTrait;
use Pars\Mvc\View\AbstractComponent;

class Tbody extends AbstractComponent implements BeanListAwareInterface
{
    use BeanListAwareTrait;

    protected function initialize()
    {
        $this->setTag('tbody');
    }

    protected function renderValue(BeanInterface $bean = null): void
    {
        parent::renderValue($bean);
        if ($this->hasBeanList()) {
            $this->setContent('');
            foreach ($this->getBeanList() as $bean) {
                $tr = new Tr();
                $this->injectDependencies($tr);
                $tr->setFieldList($this->getFieldList());
                $tr->setBean($bean);
                $tr->display();
            }
        }
    }


}
