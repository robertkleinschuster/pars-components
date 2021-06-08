<?php

namespace Pars\Component\Base\Layout;

use Pars\Component\Base\Breadcrumb\Breadcrumb;
use Pars\Component\Base\Grid\Column;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Grid\Row;
use Pars\Component\Base\Navigation\Navigation;
use Pars\Component\Base\Tabs\Tabs;
use Pars\Mvc\View\ViewElement;

class DashboardLayout extends BaseLayout
{
    public ?Navigation $navigation = null;
    public ?Breadcrumb $breadcrumb = null;
    public ?Container $container = null;

    public ?Navigation $subNavigation = null;

    protected function header(ViewElement $body)
    {
        parent::header($body);
        $this->getNavigation()->setBreakpoint(Navigation::BREAKPOINT_MEDIUM);
        $body->push($this->getNavigation());
    }


    /**
     * @param ViewElement $body
     */
    protected function main(ViewElement $main)
    {
        parent::main($main);
        $main->addInlineStyle('min-height', 'calc(100% - 120px)');
        $this->getSubNavigation()->setBackground(Navigation::BACKGROUND_LIGHT);
        $this->getSubNavigation()->setBreakpoint(Navigation::BREAKPOINT_LARGE);
        $this->getContainer()->push($this->getSubNavigation());
        $this->getContainer()->setMode(Container::MODE_FLUID);
        $this->getContainer()->addOption('sidebar');
        $main->unshift($this->getContainer());
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
        $this->injectDependencies($navigation);
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
     * @return Breadcrumb|null
     */
    public function getBreadcrumb(): ?Breadcrumb
    {
        if (!$this->hasBreadcrumb()) {
            $this->setBreadcrumb(new Breadcrumb());
        }
        return $this->breadcrumb;
    }

    /**
     * @param Breadcrumb $breadcrumb
     * @return $this
     */
    public function setBreadcrumb(Breadcrumb $breadcrumb) {
        $this->injectDependencies($breadcrumb);
        $this->breadcrumb = $breadcrumb;
        return $this;
    }


    public function hasBreadcrumb(): bool
    {
        return isset($this->breadcrumb);
    }

    /**
     * @param Navigation $navigation
     *
     * @return $this
     */
    public function setSubNavigation(Navigation $navigation): self
    {
        $this->injectDependencies($navigation);
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
