<?php

namespace Pars\Component\Base\Table;

use Pars\Bean\Type\Base\BeanAwareInterface;
use Pars\Bean\Type\Base\BeanAwareTrait;
use Pars\Bean\Type\Base\BeanInterface;
use Pars\Component\Base\Field\Badge;
use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;
use Pars\Component\Base\Form\Input;
use Pars\Core\Cache\ParsCache;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldListAwareTrait;

class Tr extends AbstractComponent implements BeanAwareInterface
{
    use BeanAwareTrait;
    use FieldListAwareTrait;

    protected function initialize()
    {
        $this->setTag('tr');
        foreach ($this->getFieldList() as $field) {
            $td = new Td();
            if (
                $field instanceof Icon
                || $field instanceof Button
                || $field instanceof Badge
                || $field instanceof Input
            ) {
                $td->setAttribute('style', 'width: 1%;');
            }
            $td->push($field);
            $this->push($td);
        }
    }

}
