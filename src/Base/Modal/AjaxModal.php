<?php


namespace Pars\Component\Base\Modal;

use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ViewElement;
use PHPUnit\TextUI\XmlConfiguration\Logging\TestDox\Html;

class AjaxModal extends AbstractComponent
{
    protected function initialize()
    {
        $modal = new ViewElement();
        $modal->setId('ajax-modal');
        $modal->addOption('modal');
        $modal->addOption('fade');
        $modal->setAttribute('tabindes', '-1');
        $modal->setRole('dialog');
        $modal->setAria('labelledby', 'ajax-modal-title');
        $modal->setAria('hidden', 'true');

        $modalDialog = new ViewElement('div.modal-dialog');
        $modalDialog->addOption('modal-dialog-scrollable');
        $modalDialog->addOption('modal-xl');
        $modalDialog->setRole('document');
        $modalContent = new ViewElement('div.modal-content');
        $modalContent->addOption('rounded-0');
        $modalHeader = new ViewElement('div.modal-header');
        $modalTitle = new ViewElement('div.modal-title');
        $modalTitle->setId('ajax-modal-title');
        $modalHeader->push($modalTitle);
        $modalClose = new ViewElement('button.close');
        $modalClose->setAttribute('type', 'button');
        $modalClose->setData('dismiss', 'modal');
        $modalClose->setContent('<span aria-hidden="true">&times;</span>');
        #$modalHeader->push($modalClose);
        $modalContent->push($modalHeader);
        $modalBody = new ViewElement('div.modal-body');
        $modalContent->push($modalBody);
        $modalFooter = new ViewElement('div.modal-footer');
        #$modalContent->push($modalFooter);
        $modalDialog->push($modalContent);
        $modal->push($modalDialog);
        $this->push($modal);
        parent::initialize();
    }
}
