<?php


namespace Pars\Component\User;


use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Component\Base\Field\Badge;
use Pars\Component\Base\Overview\Overview;

class UserOverview extends Overview
{
    use BeanListAwareTrait;

    protected function initialize()
    {
        $badge = new Badge('{UserState_Code}');
        $badge->setFormat(new UserStateFieldFormat());
        $this->append($badge);
        $this->addField('User_Username', 'Benutzername');
        $this->addField('Person_Firstname', 'Vorname');
        $this->addField('Person_Lastname', 'Nachname');
        parent::initialize();
    }

}
