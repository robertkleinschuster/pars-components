<?php


namespace Pars\Component\Base\Modal;


use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Field\Icon;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ViewElement;

class FileSelectModal extends AbstractComponent
{
    protected function initialize()
    {
        $this->setId('fileselect-modal');
        $this->addInlineStyle('z-index', '2000');
        $this->addOption('modal');
        $this->addOption('fade');
        $this->setAttribute('tabindes', '-1');
        $this->setRole('dialog');
        $this->setAria('labelledby', 'fileselect-modal-title');
        $this->setAria('hidden', 'true');

        $modalDialog = new ViewElement('div.modal-dialog');
        $modalDialog->addOption('modal-dialog-scrollable');
        $modalDialog->addOption('modal-xl');
        $modalDialog->setRole('document');
        $modalContent = new ViewElement('div.modal-content');
        $modalHeader = new ViewElement('div.modal-header');
        $modalTitle = new ViewElement('div.modal-title');
        $modalTitle->setId('fileselect-modal-title');
        $modalHeader->push($modalTitle);
        $modalClose = new ViewElement('button.close');
        $modalClose->setAttribute('type', 'button');
        $modalClose->setData('dismiss', 'modal');
        $modalClose->setContent('<span aria-hidden="true">&times;</span>');
        $modalHeader->push($modalClose);
        $modalContent->push($modalHeader);
        $modalBody = new ViewElement('div.modal-body');
        $modalContent->push($modalBody);
        $modalFooter = new ViewElement('div.modal-footer');
        $cancelButton = new Button();
        $cancelButton->setData('dismiss', 'modal');
        $cancelButton->setId('fileselect-modal-cancel');
        $cancelButton->setStyle(Button::STYLE_SECONDARY);
        $cancelButton->push(new Icon(Icon::ICON_X));
        $modalFooter->push($cancelButton);
        $cancelButton = new Button();
        $cancelButton->setData('dismiss', 'modal');
        $cancelButton->setId('fileselect-modal-submit');
        $cancelButton->setStyle(Button::STYLE_SUCCESS);
        $cancelButton->push(new Icon(Icon::ICON_CHECK));
        $modalFooter->push($cancelButton);
        $modalContent->push($modalFooter);
        $modalDialog->push($modalContent);
        $this->push($modalDialog);
        parent::initialize();
    }
}
