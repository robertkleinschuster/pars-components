<?php


namespace Pars\Component\Base\Form;


use Pars\Mvc\View\ViewElement;

class Wysiwyg extends Textarea
{
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
            /*$js = file_get_contents(__DIR__ . '/wysiwyg');
            if (is_string($js)) {
                $js = str_replace("{name}", $input->getName(), $js);
                $script = new HtmlElement('script');
                $script->setContent($js);
                $this->push($script);
            }*/
            $editor = new ViewElement('div');
            $editor->setId('edit-' . $input->getName());
            $editor->addOption('wysiwyg-editor');
            $editor->addOption('d-none');
            if ($input->hasContent()) {
                $editor->setContent($input->getContent());
            }
            $this->push($editor);
        }
    }

}
