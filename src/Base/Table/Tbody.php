<?php


namespace Pars\Component\Base\Table;


use Niceshops\Bean\Type\Base\BeanListAwareInterface;
use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldListAwareTrait;

class Tbody extends AbstractComponent implements BeanListAwareInterface
{
    use BeanListAwareTrait;
    use FieldListAwareTrait;

    protected function initialize()
    {
        $this->setTag('tbody');
        if ($this->hasBeanList()) {
            foreach ($this->getBeanList() as $bean) {
                $tr = new Tr();
                $tr->setFieldList($this->getFieldList());
                $tr->setBean($bean);
                $this->push($tr);
            }
        }
    }


}
