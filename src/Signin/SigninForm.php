<?php

namespace Pars\Component\Signin;

use Pars\Component\Base\Field\Icon;
use Pars\Component\Base\Form\Form;

class SigninForm extends Form
{
    protected function initialize()
    {
        $this->setBackground(Form::BACKGROUND_LIGHT);
        $this->setRounded(Form::ROUNDED_NONE);
        $this->setShadow(Form::SHADOW_LARGE);
        $this->setColor(Form::COLOR_DARK);
        $this->addOption('py-4');
        $this->addOption('px-sm-5');
        $this->addOption('px-3');
        $this->addInlineStyle('max-width', '450px');
        $this->addOption('mx-auto');
        $icon = new Icon( 'pars-logo');
        $icon->addInlineStyle('max-width', '200px');
        $icon->addInlineStyle('fill', '#343a40');
        $icon->addOption('mx-auto');
        $icon->addOption('mb-3');
        $this->push($icon);
        $this->addText('login_username', '', 'Benutzername');
        $this->addText('login_password', '', 'Passwort');
        $this->addHidden('login_token', '');
        $this->addSubmit('signin', 'Anmelden', 'sigin');
        parent::initialize();
    }

}
