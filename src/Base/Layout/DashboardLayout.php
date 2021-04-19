<?php

namespace Pars\Component\Base\Layout;

use Pars\Component\Base\Breadcrumb\Breadcrumb;
use Pars\Component\Base\Grid\Column;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\Grid\Row;
use Pars\Component\Base\Navigation\Navigation;
use Pars\Component\Base\Tabs\Tabs;
use Pars\Mvc\View\ViewElementElement;
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
        #$this->getNavigation()->setBackground(Navigation::BACKGROUND_DARK);
        $this->getNavigation()->setBreakpoint(Navigation::BREAKPOINT_MEDIUM);
        $body->push($this->getNavigation());
    }

    protected function components(ViewElement $components)
    {
        $row = new Row();
        $column = new Column();
        $maincolumn = new Column();
   #     $maincolumn->setSize(12);
   #     $maincolumn->setBreakpoint(Column::BREAKPOINT_EXTRA_LARGE);
        $components->addOption('ajax');
        $components->addOption('history');
        $components->setData('component', 'components');
        $components->setId('components');
        parent::components($components);
        $row->push($maincolumn);
        if ($this->exists('actionIdAfter')) {
            $tabs = new Tabs();
            $tabs->setId($this->get('actionIdAfter'));
            $tabs->setActive($this->get('actionActiveAfter'));
            foreach ($this->getComponentListSubAction() as $component) {
                $tabs->append($component);
            }
            $column->addOption('col-xl-7');
            $column->addOption('col-lg-6');
            $column->addOption('col-md-4');
            $column->addOption('col-12');
            $maincolumn->addOption('col-12');
            $maincolumn->addOption('col-xl-5');
            $maincolumn->addOption('col-lg-6');
            $maincolumn->addOption('col-md-8');
            foreach ($this->getComponentListAfter() as $component) {
                $components->push($component);
            }
            $components->push($tabs);

            $row->push($column);
        } elseif($this->getComponentListAfter()->count()) {
            foreach ($this->getComponentListAfter() as $component) {
                $components->push($component);
            }
            $column->addOption('col-xl-4');
            $column->addOption('col-lg-6');
            $column->addOption('col-md-12');
            $column->addOption('col-12');
            $maincolumn->addOption('col-xl-8');
            $maincolumn->addOption('col-lg-6');
            $maincolumn->addOption('col-md-12');
            $maincolumn->addOption('col-12');
            $row->push($column);
        }
        #$components->push($row);
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
   #     $this->getContainer()->setBreakpoint(Container::BREAKPOINT_LARGE);
        $this->getContainer()->setMode(Container::MODE_FLUID);
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
        if ($this->hasPathHelper()) {
            $this->navigation->setPathHelper($this->getPathHelper(false));
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
        if ($this->hasPathHelper()) {
            $navigation->setPathHelper($this->getPathHelper(false));
        }
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
        if ($this->hasPathHelper()) {
            $this->subNavigation->setPathHelper($this->getPathHelper(false));
        }
        return $this->subNavigation;
    }

    /**
     * @return Breadcrumb|null
     */
    public function getBreadcrumb(): ?Breadcrumb
    {
        if (!isset($this->breadcrumb)) {
            $this->breadcrumb = new Breadcrumb();
        }
        if ($this->hasPathHelper()) {
            $this->breadcrumb->setPathHelper($this->getPathHelper(false));
        }
        return $this->breadcrumb;
    }



    /**
     * @param Navigation $navigation
     *
     * @return $this
     */
    public function setSubNavigation(Navigation $navigation): self
    {
        if ($this->hasPathHelper()) {
            $navigation->setPathHelper($this->getPathHelper(false));
        }
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
