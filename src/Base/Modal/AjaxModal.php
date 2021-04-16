<?php


namespace Pars\Component\Base\Modal;

use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElement;
use PHPUnit\TextUI\XmlConfiguration\Logging\TestDox\Html;

class AjaxModal extends AbstractComponent
{
    protected function initialize()
    {
        $modal = new HtmlElement();
        $modal->setId('ajax-modal');
        $modal->addOption('modal');
        $modal->addOption('fade');
        $modal->setAttribute('tabindes', '-1');
        $modal->setRole('dialog');
        $modal->setAria('labelledby', 'ajax-modal-title');
        $modal->setAria('hidden', 'true');

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
        $modal->push($modalDialog);
        $this->push($modal);
        parent::initialize();
    }
}
