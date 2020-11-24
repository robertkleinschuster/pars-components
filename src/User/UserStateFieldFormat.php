<?php


namespace Pars\Component\User;


use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Component\Base\StyleAwareInterface;
use Pars\Mvc\View\FieldFormatInterface;
use Pars\Mvc\View\FieldInterface;

class UserStateFieldFormat implements FieldFormatInterface
{
    public function __invoke(FieldInterface $field, string $value, ?BeanInterface $bean = null): string
    {
        if (null !== $bean) {
            switch ($bean->UserState_Code) {
                case 'active':
                    if ($field instanceof StyleAwareInterface) {
                        $field->setStyle(StyleAwareInterface::STYLE_SUCCESS);
                    }
                    return 'Aktiv';
                case 'inactive':
                    if ($field instanceof StyleAwareInterface) {
                        $field->setStyle(StyleAwareInterface::STYLE_SECONDARY);
                    }
                    return 'Inaktiv';
                case 'locked':
                    if ($field instanceof StyleAwareInterface) {
                        $field->setStyle(StyleAwareInterface::STYLE_DANGER);
                    }
                    return 'Gesperrt';
            }
        }
        return $value;
    }
}
