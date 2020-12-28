<?php


namespace Pars\Component\Base\Modal;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;
use Pars\Component\Base\Form\Form;
use Pars\Component\Base\Grid\Container;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElement;

class InputModal extends AbstractComponent
{
    protected function initialize()
    {
        $this->setId('input-modal');
        $this->addOption('modal');
        $this->addOption('fade');
        $this->setAttribute('tabindes', '-1');
        $this->setRole( 'dialog');
        $this->setAria('labelledby', 'input-modal-title');
        $this->setAria('hidden', 'true');

        $modalDialog = new HtmlElement('div.modal-dialog');
        $modalDialog->setRole('document');
        $modalContent = new HtmlElement('div.modal-content');
        $modalContent->addOption('rounded-0');
        $modalHeader = new HtmlElement('div.modal-header');
        $modalTitle = new HtmlElement('div.modal-title');
        $modalTitle->setId('input-modal-title');
        $modalHeader->push($modalTitle);
        $modalClose = new HtmlElement('button.close');
        $modalClose->setAttribute('type', 'button');
        $modalClose->setData('dismiss', 'modal');
        $modalClose->setContent('<span aria-hidden="true">&times;</span>');
        $modalHeader->push($modalClose);
        $modalContent->push($modalHeader);
        $container = new Container();
        $form = new Form();
        $form->addText('input-modal-field-name', '', 'Name');
        $container->push($form);
        $modalContent->push($container);
        $modalFooter = new HtmlElement('div.modal-footer');
        $cancelButton = new Button();
        $cancelButton->setData('dismiss', 'modal');
        $cancelButton->setId('input-modal-cancel');
        $cancelButton->setStyle(Button::STYLE_SECONDARY);
        $cancelButton->push(new Icon(Icon::ICON_X));
        $modalFooter->push($cancelButton);
        $inputButton = new Button();
        $inputButton->setId('input-modal-submit');
        $modalFooter->push($inputButton);
        $modalContent->push($modalFooter);
        $modalDialog->push($modalContent);
        $this->push($modalDialog);
        parent::initialize();
    }

}
