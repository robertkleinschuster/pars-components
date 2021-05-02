<?php


namespace Pars\Component\Base\Modal;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ViewElement;

class Modal extends AbstractComponent
{
    protected ViewElement $modalContent;
    protected ViewElement $modalHeader;
    protected ViewElement $modalTitle;
    protected ViewElement $modalBody;
    protected ViewElement $modalFooter;

    protected function initialize()
    {
        parent::initialize();
        $this->addOption('modal');
        $this->setAttribute('tabindex', '-1');
        $this->getMain()->addOption('modal-dialog');
        $this->getMain()->addOption('modal-dialog-scrollable');
        $this->getMain()->addOption('modal-dialog-centered');
        $this->getMain()->push($this->getModalContent());
        $this->getModalContent()->push($this->getModalHeader());
        $this->getModalHeader()->push($this->getModalTitle());
        $this->getModalContent()->push($this->getModalBody());
        $this->getModalContent()->push($this->getModalFooter());
        $this->getModalContent()->addOption('modal-content');
        $this->getModalHeader()->addOption('modal-header');
        $this->getModalTitle()->addOption('modal-title');
        $this->getModalBody()->addOption('modal-body');
        $this->getModalFooter()->addOption('modal-footer');

    }


    /**
     * @return ViewElement
     */
    public function getModalContent(): ViewElement
    {
        if (!isset($this->modalContent)) {
            $this->modalContent = new ViewElement();
        }
        return $this->modalContent;
    }

    /**
     * @return ViewElement
     */
    public function getModalHeader(): ViewElement
    {
        if (!isset($this->modalHeader)) {
            $this->modalHeader = new ViewElement();
        }
        return $this->modalHeader;
    }

    /**
     * @return ViewElement
     */
    public function getModalTitle(): ViewElement
    {
        if (!isset($this->modalTitle)) {
            $this->modalTitle = new ViewElement();
        }
        return $this->modalTitle;
    }

    /**
     * @return ViewElement
     */
    public function getModalBody(): ViewElement
    {
        if (!isset($this->modalBody)) {
            $this->modalBody = new ViewElement();
        }
        return $this->modalBody;
    }

    /**
     * @return ViewElement
     */
    public function getModalFooter(): ViewElement
    {
        if (!isset($this->modalFooter)) {
            $this->modalFooter = new ViewElement();
        }
        return $this->modalFooter;
    }




}
