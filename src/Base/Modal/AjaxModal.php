<?php


namespace Pars\Component\Base\Modal;

use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElement;

class AjaxModal extends AbstractComponent
{
    protected function initialize()
    {
        $this->setId('ajax-modal');
        $this->addOption('modal');
        $this->addOption('fade');
        $this->setAttribute('tabindes', '-1');
        $this->setRole('dialog');
        $this->setAria('labelledby', 'ajax-modal-title');
        $this->setAria('hidden', 'true');

        $modalDialog = new HtmlElement('div.modal-dialog');
        $modalDialog->addOption('modal-dialog-scrollable');
        $modalDialog->addOption('modal-xl');
        $modalDialog->setRole('document');
        $modalContent = new HtmlElement('div.modal-content');
        $modalContent->addOption('rounded-0');
        $modalHeader = new HtmlElement('div.modal-header');
        $modalTitle = new HtmlElement('div.modal-title');
        $modalTitle->setId('ajax-modal-title');
        $modalHeader->push($modalTitle);
        $modalClose = new HtmlElement('button.close');
        $modalClose->setAttribute('type', 'button');
        $modalClose->setData('dismiss', 'modal');
        $modalClose->setContent('<span aria-hidden="true">&times;</span>');
        #$modalHeader->push($modalClose);
        $modalContent->push($modalHeader);
        $modalBody = new HtmlElement('div.modal-body');
        $modalContent->push($modalBody);
        $modalFooter = new HtmlElement('div.modal-footer');
        #$modalContent->push($modalFooter);
        $modalDialog->push($modalContent);
        $this->push($modalDialog);
        parent::initialize();
    }
}
