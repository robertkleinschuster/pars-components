<?php


namespace Pars\Component\Base\Modal;


use Pars\Component\Base\Field\Button;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElement;

class ConfirmModal extends AbstractComponent
{
    protected function initialize()
    {
        $this->setId('confirm-modal');
        $this->addOption('modal');
        $this->addOption('fade');
        $this->setAttribute('tabindes', '-1');
        $this->setRole( 'dialog');
        $this->setAria('labelledby', 'confirm-modal-title');
        $this->setAria('hidden', 'true');

        $modalDialog = new HtmlElement('div.modal-dialog');
        $modalDialog->setRole('document');
        $modalContent = new HtmlElement('div.modal-content');
        $modalContent->addOption('rounded-0');
        $modalHeader = new HtmlElement('div.modal-header');
        $modalTitle = new HtmlElement('div.modal-title');
        $modalTitle->setId('confirm-modal-title');
        $modalHeader->push($modalTitle);
        $modalClose = new HtmlElement('button.close');
        $modalClose->setAttribute('type', 'button');
        $modalClose->setData('dismiss', 'modal');
        $modalClose->setContent('<span aria-hidden="true">&times;</span>');
        $modalHeader->push($modalClose);
        $modalContent->push($modalHeader);
        $modalFooter = new HtmlElement('div.modal-footer');

        $cancelButton = new Button();
        $cancelButton->setData('dismiss', 'modal');
        $cancelButton->setId('confirm-modal-cancel');
        $cancelButton->setStyle(Button::STYLE_SECONDARY);
        $modalFooter->push($cancelButton);
        $confirmButton = new Button();
        $confirmButton->setId('confirm-modal-submit');
        $modalFooter->push($confirmButton);
        $modalContent->push($modalFooter);
        $modalDialog->push($modalContent);
        $this->push($modalDialog);
        parent::initialize();
    }

}
