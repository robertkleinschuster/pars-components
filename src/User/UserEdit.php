<?php


namespace Pars\Component\User;


use Niceshops\Bean\Type\Base\BeanAwareTrait;
use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Component\Base\Edit\Edit;
use Pars\Helper\Parameter\SubmitParameter;

class UserEdit extends Edit
{
    use BeanAwareTrait;

    protected function initialize()
    {
        parent::initialize();
        $this->getForm()->addText('Person_Firstname', '{Person_Firstname}', 'Vorname', 1, 1);
        $this->getForm()->addText('Person_Lastname', '{Person_Lastname}', 'Nachname', 1, 2);
        $this->getForm()->addText('User_Username', '{User_Username}', 'Benutzername', 3, 1);
        $this->getForm()->addPassword('User_Password', '{User_Password}', 'Passwort', 3, 2);
        $this->getForm()->addText('User_Displayname', '{User_Displayname}', 'Anzeigename', 2);
        $this->getForm()->addSubmit(SubmitParameter::getParameterKey(), 'Speichern', (new SubmitParameter())->setSave(), null, '', 4,1);
        $this->getForm()->addCancel('Abbrechen', '/', 4, 2);
    }

    public function render(BeanInterface $bean = null): string
    {
        if ($this->hasBean()) {
            $bean = $this->getBean();
        }
        return parent::render($bean);
    }
}
