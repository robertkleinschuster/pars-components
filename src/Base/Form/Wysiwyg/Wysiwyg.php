<?php


namespace Pars\Component\Base\Form\Wysiwyg;


use Pars\Bean\Type\Base\AbstractBaseBean;
use Pars\Component\Base\Form\Textarea;
use Pars\Mvc\View\ViewElement;

class Wysiwyg extends Textarea
{
    protected ActionList $actionList;

    protected function initialize()
    {
        $this->addOption('wysiwyg-wrap');
        $id = $this->generateId();
        $input = new Textarea();
        $input->addOption('wysiwyg-textarea');
        $input->fromArray($this->toArray());
        if ($this->hasValue()) {
            $input->setContent($this->getValue());
        }
        $input->setValue('');
        $this->setValue('');
        $this->push($input);
        $this->setName('wysiwyg-' . $id);
        parent::initialize();
        $this->removeOption('form-control');
        $this->setTag('div');
        if ($input->hasName()) {
            $editor = new ViewElement('div');
            $editor->setId('edit-' . $input->getName());
            $editor->addOption('wysiwyg-editor');
            $editor->addOption('d-none');
            $this->push($editor);
        }
        $this->setData('actions', json_encode($this->getActionList()));
    }

    /**
     * @return ActionList
     */
    public function getActionList(): ActionList
    {
        if (!isset($this->actionList)) {
            $this->actionList = new ActionList();
        }
        return $this->actionList;
    }

    public function addOptionDropdown(string $label, array $options, string $title = null)
    {
        $placeholderActionDropdown = new Action();
        $placeholderActionDropdown->name = $label;
        $placeholderActionDropdown->icon = $label;
        $placeholderActionDropdown->title = $title;
        foreach ($options as $value => $label) {
            $placeholderAction = new Action();
            $placeholderAction->name = $label;
            $placeholderAction->icon = $label;
            $placeholderAction->command = 'insertText';
            $placeholderAction->commandValue = $value;
            $placeholderActionDropdown->getDropdown()->push($placeholderAction);
        }
        $this->getActionList()->push($placeholderActionDropdown);
    }

}
