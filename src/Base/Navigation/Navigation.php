<?php

declare(strict_types=1);

namespace Pars\Component\Base\Navigation;


use Pars\Component\Base\BackgroundAwareInterface;
use Pars\Component\Base\BackgroundAwareTrait;
use Pars\Component\Base\BorderAwareInterface;
use Pars\Component\Base\BorderAwareTrait;
use Pars\Component\Base\BreakpointAwareInterface;
use Pars\Component\Base\BreakpointAwareTrait;
use Pars\Component\Base\ContrastTrait;
use Pars\Component\Base\Form\Form;
use Pars\Component\Base\Form\Input;
use Pars\Component\Base\Grid\Container;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ViewElement;

/**
 * Class Navigation
 * @package Pars\Component\Navigation
 */
class Navigation extends AbstractComponent implements BreakpointAwareInterface, BackgroundAwareInterface, BorderAwareInterface
{
    use BreakpointAwareTrait;
    use BackgroundAwareTrait;
    use BorderAwareTrait;
    use ContrastTrait;

    protected Container $container;

    /**
     * @var Collapse|null
     */
    protected ?Collapse $collapse = null;

    /**
     * @var Input|null
     */
    protected ?Input $search = null;

    protected ?string $searchAction = null;

    protected ?ViewElement $toggle = null;

    protected bool $expanded = false;


    /**
     * @return bool
     */
    public function isExpanded(): bool
    {
        return $this->expanded;
    }

    /**
     * @param bool $expanded
     * @return Navigation
     */
    public function setExpanded(bool $expanded): Navigation
    {
        $this->expanded = $expanded;
        return $this;
    }

    /**
     * @throws \Pars\Pattern\Exception\AttributeExistsException
     * @throws \Pars\Pattern\Exception\AttributeLockException
     * @throws \Pars\Pattern\Exception\AttributeNotFoundException
     */
    protected function initialize()
    {
        if (!$this->isEmpty()) {
            $this->getContainer()->setMode(Container::MODE_FLUID);
            $this->setExpanded($this->getState()->get('expanded', $this->isExpanded()));
            $this->setTag('nav');
            $this->addOption('navbar');
            $this->addOption('mb-1');
            $this->addOption('py-1');
            if ($this->hasBackground()) {
                $this->addOption($this->getBackground());
                if ($this->getBackground() == self::BACKGROUND_DARK) {

                    $this->addOption('navbar-dark');
                } elseif ($this->getBackground() == self::BACKGROUND_LIGHT) {
                    $this->addOption('navbar-light');
                    $this->addOption('border');
                    $this->addOption('rounded');
                } elseif ($this->getBackground() == self::BACKGROUND_DANGER) {
                    $this->addOption('navbar-dark');

                }
            }

            if ($this->hasRounded()) {
                $this->addOption($this->getRounded());
            }
            if ($this->hasBorder()) {
                $this->addOption($this->getBorder());
            }
            if ($this->hasBorderPosition()) {
                $this->addOption($this->getBorderPosition());
            }
            if ($this->hasBreakpoint()) {
                $this->addOption('navbar-expand-' . $this->getBreakpoint());
                $toggle = $this->getToggle();
                if ($this->isExpanded()) {
                    $toggle->setAria('expanded', 'true');
                    $this->getCollapse()->addOption('show');
                } else {
                    $this->getCollapse()->removeOption('show');
                    $toggle->setAria('expanded', 'false');
                }
                $toggle->setAttribute('type', 'button');
                $id = $this->getId() . '_collapse';
                $this->getCollapse()->setId($id);
                $toggle->setData('bs-target', '#' . $id);
                $toggle->setData('bs-toggle', 'collapse');
                $toggle->setAria('controls', $id);
                $toggle->setAria('label', 'Toggle navigation');
                $toggle->push(new ViewElement('span.navbar-toggler-icon'));
                $this->getContainer()->push($toggle);
            } else {
                $this->addOption('navbar-expand');
            }
            $this->getContainer()->push($this->getCollapse());
            if ($this->hasSearch()) {
                $form = new Form();
                $form->setUseColumns(false);
                if ($this->hasSearchAction()) {
                    $form->setAction($this->getSearchAction());
                }
                if ($this->hasBackground()) {
                    $this->getSearch()->setBackground($this->getBackground());
                    $this->getSearch()->setColor($this->getContrast()->getColor($this->getBackground()));
                }
                $this->getSearch()->setBorder(Input::BORDER_SECONDARY);
                $form->push($this->getSearch());
                $this->getCollapse()->push($form);
            }
            $this->push($this->getContainer());
        }

    }


    public function getContainer()
    {
        if (!isset($this->container)) {
            $this->container = new Container();
        }
        return $this->container;
    }

    /**
     * @return ViewElement|null
     */
    public function getToggle(): ?ViewElement
    {
        if (!isset($this->toggle)) {
            $this->toggle = new ViewElement('button.navbar-toggler');
        }
        return $this->toggle;
    }


    /**
     * @param string $value
     * @param string $path
     * @return Brand
     */
    public function setBrand(string $value, string $path): Brand
    {
        $brand = new Brand();
        $brand->setContent($value);
        $brand->setPath($path);
        $this->getContainer()->unshift($brand);
        return $brand;
    }

    /**
     * @param string $content
     * @param string $path
     * @param string $id
     * @param int|null $order
     * @param bool $active
     * @return Item
     */
    public function addItem(string $content, string $path, string $id, ?int $order = null, bool $active = false): Item
    {
        $item = new Item();
        $item->setContent($content);
        $item->setPath($path);
        $item->setActive($active);
        $item->setId($id);
        if (null !== $order) {
            $item->addOption('order-' . $order);
        }
        $this->getCollapse()->addItem($item);
        return $item;
    }

    /**
     * @param string $content
     * @param string $path
     * @param string $id
     * @param int|null $order
     * @param bool $active
     * @return Item
     */
    public function addItemRight(string $content, string $path, string $id, ?int $order = null, bool $active = false): Item
    {
        $item = new Item();
        $item->setContent($content);
        $item->setPath($path);
        $item->setActive($active);
        $item->setId($id);
        if (null !== $order) {
            $item->addOption('order-' . $order);
        }
        $this->getCollapse()->addItemRight($item);
        return $item;
    }

    /**
     * @param string $content
     * @param string $id
     * @param int|null $order
     * @param bool $active
     * @return Dropdown
     */
    public function addDropdownRight(string $content, string $id, ?int $order = null, bool $active = false): Dropdown
    {
        $dropdown = new Dropdown();
        $dropdown->setContent($content);
        $dropdown->setActive($active);
        $dropdown->setId($id);
        if (null !== $order) {
            $dropdown->addOption('order-' . $order);
        }
        $this->getCollapse()->addItemRight($dropdown);
        return $dropdown;
    }

    public function isEmpty(): bool
    {
        return $this->getCollapse()->isEmpty() && !$this->hasSearch();
    }

    public function setActive(string $id): self
    {
        $this->getCollapse()->setActive($id);
        return $this;
    }

    /**
     * @return Collapse
     */
    protected function getCollapse(): Collapse
    {
        if (null === $this->collapse) {
            $this->collapse = new Collapse();
        }
        return $this->collapse;
    }

    /**
     * @return Input
     */
    public function getSearch(): Input
    {
        return $this->search;
    }

    /**
     * @return string
     */
    public function getActive(): string
    {
        return $this->getCollapse()->getActive();
    }

    /**
     * @return string
     */
    public function hasActive(): bool
    {
        return $this->getCollapse()->hasActive();
    }

    /**
     * @param string $name
     * @param string $placeholder
     * @return $this
     */
    public function setSearch(string $name, string $placeholder): self
    {
        $this->search = new Input();
        $this->search->setName($name);
        $this->search->setPlaceholder($placeholder);
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSearch(): bool
    {
        return $this->search !== null;
    }

    /**
     * @return string
     */
    public function getSearchAction(): string
    {
        return $this->searchAction;
    }

    /**
     * @param string $searchAction
     *
     * @return $this
     */
    public function setSearchAction(string $searchAction): self
    {
        $this->searchAction = $searchAction;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasSearchAction(): bool
    {
        return isset($this->searchAction);
    }

}
