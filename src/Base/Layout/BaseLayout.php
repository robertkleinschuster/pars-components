<?php

namespace Pars\Component\Base\Layout;

use Pars\Component\Base\Form\FormGroup;
use Pars\Component\Base\Form\Input;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Modal\ConfirmModal;
use Pars\Component\Base\Modal\AjaxModal;
use Pars\Component\Base\Modal\FileSelectModal;
use Pars\Mvc\View\AbstractLayout;
use Pars\Mvc\View\ViewElement;

class BaseLayout extends AbstractLayout
{
    protected bool $wide = true;

    protected function initialize()
    {
        $this->setTag('html');
        $this->addOption('h-100');
        $this->addOption('reload');
        $this->setAttribute('lang', '{language}');
        $head = new ViewElement('head');
        $this->meta($head);
        $title = new ViewElement('title');
        $title->setContent('{title}');
        $head->push($title);
        $base = new ViewElement('base');
        $base->setAttribute('href', '{baseUrl}');
        $head->push($base);
        $link = new ViewElement('link');
        $link->setAttribute('rel', 'shortcut icon');
        $link->setAttribute('href', '{favicon}');
        $head->push($link);
        $this->stylesheets($head);
        $this->push($head);
        $body = new ViewElement('body');
        $body->addOption('h-100');
        $header = new ViewElement('header');
        $header->setId('header');
        $this->header($header);
        $body->push($header);
        $main = new ViewElement('main');
        $main->setId('main');
        $this->main($main);
        $body->push($main);
        $footer = new ViewElement('footer.footer');
        $footer->setId('footer');
        $this->footer($footer);
        $body->push($footer);
        $this->scripts($body);
        $body->push(new ConfirmModal());
        $body->push(new FileSelectModal());
        $body->push(new AjaxModal());
        $this->push($body);
        $inputTemplate = new ViewElement('div');
        $inputTemplate->setId('dynamic-field-template');
        $inputTemplate->addOption('d-none');
        $formGroup = new FormGroup('{name}');
        $formGroup->setLabel('{label}');
        $input = new Input(Input::TYPE_TEXT);
        $formGroup->setInput($input);
        $inputTemplate->getElementList()->push($formGroup);
        $body->push($inputTemplate);
    }

    protected function header(ViewElement $header)
    {

    }

    protected function main(ViewElement $main)
    {
        $components = new Container('div.components');
        if ($this->isWide()) {
            $components->setMode(Container::MODE_FLUID);
        } else {
            $components->setBreakpoint(Container::BREAKPOINT_LARGE);
        }
        $this->components($components);
        $main->push($components);
        $main->push((new ViewElement('div'))->setId('subactions'));
    }

    protected function components(ViewElement $components)
    {
        foreach ($this->getComponentList() as $component) {
            $components->push($component);
        }
    }

    protected function footer(ViewElement $footer)
    {
        $copyright = new ViewElement('span.text-muted');
        $copyright->setContent("PARS " . PARS_VERSION);
        $container = new Container();
        $container->push($copyright);
        $footer->addOption('py-3');
        $footer->addOption('bg-light');
        $footer->push($container);
    }

    protected function meta(ViewElement $head)
    {
        $meta = new ViewElement('meta');
        $meta->setAttribute('charset', '{charset}');
        $head->push($meta);
        $meta = new ViewElement('meta');
        $meta->setAttribute('name', 'viewport');
        $meta->setAttribute('content', 'width=device-width, initial-scale=1, shrink-to-fit=no');
        $head->push($meta);
        $meta = new ViewElement('meta');
        $meta->setAttribute('name', 'description');
        $meta->setAttribute('content', '{description}');
        $head->push($meta);
        $meta = new ViewElement('meta');
        $meta->setAttribute('name', 'author');
        $meta->setAttribute('content', '{author}');
        $head->push($meta);
    }

    /**
     * @param ViewElement $head
     * @throws \Pars\Pattern\Exception\AttributeExistsException
     * @throws \Pars\Pattern\Exception\AttributeLockException
     */
    protected function stylesheets(ViewElement $head)
    {
        if ($this->hasView()) {
            foreach ($this->getView()->getStylesheets() as $file) {
                $link = new ViewElement('link');
                $link->setAttribute('rel', 'stylesheet');
                $link->setAttribute('href', $file);
                $head->push($link);
            }
        }
    }

    /**
     * @param ViewElement $body
     * @throws \Pars\Pattern\Exception\AttributeExistsException
     * @throws \Pars\Pattern\Exception\AttributeLockException
     */
    protected function scripts(ViewElement $body)
    {
        if ($this->hasView()) {
            foreach ($this->getView()->getJavascript() as $file) {
                $script = new ViewElement('script');
                $script->setAttribute('src', $file);
                $body->push($script);
            }
        }
    }

    /**
     * @return bool
     */
    public function isWide(): bool
    {
        return $this->wide;
    }

    /**
     * @param bool $wide
     */
    public function setWide(bool $wide): void
    {
        $this->wide = $wide;
    }


}
