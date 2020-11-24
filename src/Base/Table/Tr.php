<?php


namespace Pars\Component\Base\Table;


use Niceshops\Bean\Type\Base\BeanAwareInterface;
use Niceshops\Bean\Type\Base\BeanAwareTrait;
use Pars\Component\Base\Field\Badge;
use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;
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
            try {
                if (
                    $field instanceof Icon
                    || $field instanceof Button
                    || $field instanceof Badge
                ) {
                    $td->setAttribute('style', 'width: 1%;');
                }

                if ($this->hasBean()) {
                    $td->setContent($field->render($this->getBean()));
                } else {
                    $td->setContent($field->render());
                }
            } catch (\Throwable $ex) {
                $td->setContent($ex->getMessage());
            }
            $this->push($td);
        }
    }

}
