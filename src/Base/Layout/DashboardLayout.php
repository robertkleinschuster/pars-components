<?php

namespace Pars\Component\Base\Layout;

use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Navigation\Navigation;
use Pars\Component\Base\Tabs\Tabs;
use Pars\Mvc\View\HtmlElement;

class DashboardLayout extends BaseLayout
{
    public ?Navigation $navigation = null;

    public ?Container $container = null;

    public ?Navigation $subNavigation = null;

    protected function header(HtmlElement $body)
    {
        parent::header($body);
        $this->getNavigation()->setBackground(Navigation::BACKGROUND_DARK);
        $this->getNavigation()->setBreakpoint(Navigation::BREAKPOINT_MEDIUM);
        $body->push($this->getNavigation());
    }

    protected function components(HtmlElement $components)
    {
        if ($this->exists('actionIdBefore')) {
            $tabs = new Tabs();
            $tabs->setId($this->get('actionIdBefore'));
            $tabs->setActive($this->get('actionActiveBefore'));
            foreach ($this->getComponentListBefore() as $component) {
                $tabs->append($component);
            }
            $components->push($tabs);
        }
        $components->addOption('ajax');
        $components->addOption('history');
        $components->setData('component', 'components');
        $components->setId('components');
        parent::components($components);
        if ($this->exists('actionIdAfter')) {
            $tabs = new Tabs();
            $tabs->setId($this->get('actionIdAfter'));
            $tabs->setActive($this->get('actionActiveAfter'));
            foreach ($this->getComponentListAfter() as $component) {
                $tabs->append($component);
            }
            $components->push($tabs);
        }
    }


    /**
     * @param HtmlElement $body
     */
    protected function main(HtmlElement $main)
    {
        parent::main($main);
        $main->addInlineStyle('min-height', 'calc(100% - 140px)');
        $this->getSubNavigation()->setBackground(Navigation::BACKGROUND_LIGHT);
        $this->getSubNavigation()->setBreakpoint(Navigation::BREAKPOINT_LARGE);
        $this->getContainer()->push($this->getSubNavigation());
        $this->getContainer()->setBreakpoint(Container::BREAKPOINT_LARGE);
        $main->push($this->getContainer());
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        if (!$this->hasContainer()) {
            $this->setContainer(new Container());
        }
        return $this->container;
    }

    /**
     * @param Container $container
     *
     * @return $this
     */
    public function setContainer(Container $container): self
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasContainer(): bool
    {
        return $this->container !== null;
    }


    /**
     * @return Navigation
     */
    public function getNavigation(): Navigation
    {
        if (!$this->hasNavigation()) {
            $this->setNavigation(new Navigation());
        }
        return $this->navigation;
    }

    /**
     * @param Navigation $navigation
     *
     * @return $this
     */
    public function setNavigation(Navigation $navigation): self
    {
        $this->navigation = $navigation;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasNavigation(): bool
    {
        return $this->navigation !== null;
    }

    /**
     * @return Navigation
     */
    public function getSubNavigation(): Navigation
    {
        if (!$this->hasSubNavigation()) {
            $this->setSubNavigation(new Navigation());
        }
        return $this->subNavigation;
    }

    /**
     * @param Navigation $navigation
     *
     * @return $this
     */
    public function setSubNavigation(Navigation $navigation): self
    {
        $this->subNavigation = $navigation;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSubNavigation(): bool
    {
        return $this->subNavigation !== null;
    }


}
