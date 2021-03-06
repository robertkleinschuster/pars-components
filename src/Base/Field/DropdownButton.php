<?php


namespace Pars\Component\Base\Field;


use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\FieldList;
use Pars\Mvc\View\ViewElement;

class DropdownButton extends AbstractField
{
    protected Button $button;
    protected ?Button $dropdownButton = null;
    protected FieldList $dropdownList;

    /**
     * DropdownButton constructor.
     * @param Button $button
     */
    public function __construct(Button $button)
    {
        $this->button = $button;
        $this->dropdownList = new FieldList();
        parent::__construct();
    }

    /**
     * @return Button|null
     */
    public function getDropdownButton(): ?Button
    {
        if ($this->dropdownButton == null) {
            $this->dropdownButton = new Button();
        }
        return $this->dropdownButton;
    }



    protected function initialize()
    {
        parent::initialize();
        $this->addOption('btn-group');
        $this->push($this->getButton());
        $this->getButton()->removeOption('me-1');
        $dropdownButton = $this->getDropdownButton();
        $dropdownButton->addOption('dropdown-toggle');
        $dropdownButton->addOption('dropdown-toggle-split');
        $dropdownButton->setData('bs-toggle', 'dropdown');
        $dropdownButton->setAria('haspopup', 'true');
        $dropdownButton->setAria('expanded', 'false');
        $this->push($dropdownButton);
        $dropdown = new ViewElement('div.dropdown-menu');
        foreach ($this->getDropdownList() as $item) {
            $item->addOption('dropdown-item');
            $dropdown->push($item);
        }
        $this->push($dropdown);
    }

    /**
     * @return FieldList
     */
    public function getDropdownList(): FieldList
    {
        return $this->dropdownList;
    }

    /**
     * @return Button
     */
    public function getButton(): Button
    {
        return $this->button;
    }


}
