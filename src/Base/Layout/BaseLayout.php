<?php

namespace Pars\Component\Base\Layout;

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
        $this->header($header);
        $body->push($header);
        $main = new HtmlElement('main');
        $this->main($main);
        $components = new HtmlElement('div.components');
        $this->components($components);
        $main->push($components);
        $body->push($main);
        $footer = new HtmlElement('footer.footer');
        $this->footer($footer);
        $body->push($footer);
        $this->scripts($body);
        $body->push(new ConfirmModal());
        $this->push($body);
    }

    protected function header(HtmlElement $header) {

    }
    protected function main(HtmlElement $main) {

    }
    protected function components(HtmlElement $components) {
        foreach ($this->getComponentList() as $component) {
            $components->push($component);
        }
    }

    protected function footer(HtmlElement $footer) {
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
        $link = new HtmlElement('link');
        $link->setAttribute('rel', 'stylesheet');
        $link->setAttribute('href', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css');
        $link->setAttribute('integrity', 'sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2');
        $link->setAttribute('crossorigin', 'anonymous');
        $head->push($link);
        $link = new HtmlElement('link');
        $link->setAttribute('rel', 'stylesheet');
        $link->setAttribute('href', 'https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css');
        $link->setAttribute('integrity', 'sha256-jyIuRMWD+rz7LdpWfybO8U6DA65JCVkjgrt31FFsnAE=');
        $link->setAttribute('crossorigin', 'anonymous');
        $head->push($link);
        $link = new HtmlElement('link');
        $link->setAttribute('rel', 'stylesheet');
        $link->setAttribute('href', 'https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.bubble.css');
        $link->setAttribute('integrity', 'sha256-2hxHujXw890GumwDHPWrwJCtdZZdrJanlGsrOTSfXnc=');
        $link->setAttribute('crossorigin', 'anonymous');
        $head->push($link);
    }

    /**
     * @param HtmlElement $body
     */
    protected function scripts(HtmlElement $body)
    {
        $script = new HtmlElement('script');
        $script->setAttribute('src', 'https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js');
        $script->setAttribute('integrity', 'sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=');
        $script->setAttribute('crossorigin', 'anonymous');
        $body->push($script);
        $script = new HtmlElement('script');
        $script->setAttribute('src', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js');
        $script->setAttribute('integrity', 'sha256-H4Qt7pVBp547bdul9EtvPU/m+XQ9EQTsYH7zFe5W9Gw=');
        $script->setAttribute('crossorigin', 'anonymous');
        $body->push($script);
        $script = new HtmlElement('script');
        $script->setAttribute('src', 'https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js');
        $script->setAttribute('integrity', 'sha256-XfzdiC+S1keia+s9l07y7ye5a874sBq67zK4u7LTjvk=');
        $script->setAttribute('crossorigin', 'anonymous');
        $body->push($script);
        $script = new HtmlElement('script');
        $script->setAttribute('src', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js');
        $script->setAttribute('integrity', 'sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s');
        $script->setAttribute('crossorigin', 'anonymous');
        $body->push($script);
        $script = new HtmlElement('script');
        $script->setAttribute('src', 'https://cdn.jsdelivr.net/npm/bs-custom-file-input@1.3.4/dist/bs-custom-file-input.min.js');
        $script->setAttribute('integrity', 'sha256-e0DUqNhsFAzOlhrWXnMOQwRoqrCRlofpWgyhnrIIaPo=');
        $script->setAttribute('crossorigin', 'anonymous');
        $body->push($script);
        $script = new HtmlElement('script');
        $script->setAttribute('src', 'https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js');
        $script->setAttribute('integrity', 'sha256-xnX1c4jTWYY3xOD5/hVL1h37HCCGJx+USguyubBZsHQ=');
        $script->setAttribute('crossorigin', 'anonymous');
        $body->push($script);
        $script = new HtmlElement('script');
        $js = file_get_contents(__DIR__ . '/confirm-modal.js');
        $script->setContent($js);
        $body->push($script);
        $script = new HtmlElement('script');
        $js = file_get_contents(__DIR__ . '/select-all.js');
        $script->setContent($js);
        $body->push($script);
    }
}
