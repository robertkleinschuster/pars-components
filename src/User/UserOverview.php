<?php


namespace Pars\Component\User;


use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Component\Base\Field\Badge;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Overview\Overview;

class UserOverview extends Overview
{
    use BeanListAwareTrait;

    protected function initialize()
    {
        parent::initialize();
        $badge = new Badge('{UserState_Code}');
        $badge->setFormat(new UserStateFieldFormat());
        $this->getTable()->getFieldList()->push($badge);
        $this->getTable()->getFieldList()->push(new Span('{Person_Firstname} {Person_Lastname}', 'Name'));
        $this->getTable()->getFieldList()->push(new Span('{User_Username}', 'Benutzername'));
    }

}
