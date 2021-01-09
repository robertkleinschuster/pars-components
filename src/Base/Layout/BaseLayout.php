<?php

namespace Pars\Component\Base\Layout;

use Pars\Component\Base\Form\FormGroup;
use Pars\Component\Base\Form\Input;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Modal\ConfirmModal;
use Pars\Mvc\View\AbstractLayout;
use Pars\Mvc\View\HtmlElement;

class BaseLayout extends AbstractLayout
{

    protected function initialize()
    {
        $this->setTag('html');
        $this->addOption('h-100');
        $this->setAttribute('lang', '{language}');
        $head = new HtmlElement('head');
        $this->meta($head);
        $title = new HtmlElement('title');
        $title->setContent('{title}');
        $head->push($title);
        $link = new HtmlElement('link');
        $link->setAttribute('rel', 'shortcut icon');
        $link->setAttribute('href', '{favicon}');
        $head->push($link);
        $this->stylesheets($head);
        $this->push($head);
        $body = new HtmlElement('body');
        $body->addOption('h-100');
        $header = new HtmlElement('header');
        $header->setId('header');
        $this->header($header);
        $body->push($header);
        $main = new HtmlElement('main');
        $main->setId('main');
        $this->main($main);
        $components = new Container('div.components');
        $this->components($components);
        $main->push($components);
        $body->push($main);
        $footer = new HtmlElement('footer.footer');
        $footer->setId('footer');
        $this->footer($footer);
        $body->push($footer);
        $this->scripts($body);
        $body->push(new ConfirmModal());
        $this->push($body);
        $inputTemplate = new HtmlElement('div');
        $inputTemplate->setId('dynamic-field-template');
        $inputTemplate->addOption('d-none');
        $formGroup = new FormGroup('{name}');
        $formGroup->setLabel('{label}');
        $input = new Input(Input::TYPE_TEXT);
        $formGroup->setInput($input);
        $inputTemplate->getElementList()->push($formGroup);
        $body->push($inputTemplate);
    }

    protected function header(HtmlElement $header)
    {

    }

    protected function main(HtmlElement $main)
    {

    }

    protected function components(HtmlElement $components)
    {
        foreach ($this->getComponentList() as $component) {
            $components->push($component);
        }
    }

    protected function footer(HtmlElement $footer)
    {
        $copyright = new HtmlElement('span.text-muted');
        $year = date('Y');
        $copyright->setContent("&copy; {$year}  <a href=\"https://kleinschuster.de\">Robert Kleinschuster</a>");
        $container = new Container();
        $container->push($copyright);
        $footer->addOption('py-3');
        $footer->addOption('bg-light');
        $footer->push($container);
    }

    protected function meta(HtmlElement $head)
    {
        $meta = new HtmlElement('meta');
        $meta->setAttribute('charset', '{charset}');
        $head->push($meta);
        $meta = new HtmlElement('meta');
        $meta->setAttribute('name', 'viewport');
        $meta->setAttribute('content', 'width=device-width, initial-scale=1, shrink-to-fit=no');
        $head->push($meta);
        $meta = new HtmlElement('meta');
        $meta->setAttribute('name', 'description');
        $meta->setAttribute('content', '{description}');
        $head->push($meta);
        $meta = new HtmlElement('meta');
        $meta->setAttribute('name', 'author');
        $meta->setAttribute('content', '{author}');
        $head->push($meta);
    }

    protected function stylesheets(HtmlElement $head)
    {
        foreach ($this->getStaticFiles() as $bundle) {
            if ($bundle['type'] == 'css') {
                $link = new HtmlElement('link');
                $link->setAttribute('rel', 'stylesheet');
                $link->setAttribute('href', '/' . $bundle['output']);
                $head->push($link);
            }
        }
    }

    /**
     * @param HtmlElement $body
     */
    protected function scripts(HtmlElement $body)
    {
        foreach ($this->getStaticFiles() as $bundle) {
            if ($bundle['type'] == 'js') {
                $script = new HtmlElement('script');
                $script->setAttribute('src', '/' . $bundle['output']);
                $body->push($script);
            }
        }
    }
}
