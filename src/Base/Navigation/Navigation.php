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
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlElement;

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

    /**
     * @var Collapse|null
     */
    protected ?Collapse $collapse = null;

    /**
     * @var Input|null
     */
    protected ?Input $search = null;

    protected ?string $searchAction = null;

    /**
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     * @throws \Niceshops\Core\Exception\AttributeNotFoundException
     */
    protected function initialize()
    {
        if (!$this->isEmpty()) {
            $this->setTag('nav');
            $this->addOption('navbar');
            $this->addOption('mb-1');
            $this->addOption('shadow-sm');
            if ($this->hasBackground()) {
                $this->addOption($this->getBackground());
                $this->addOption(str_replace('bg', 'navbar', $this->getBackground()));
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
                $toggle = new HtmlElement('button.navbar-toggler.rounded-0');
                $toggle->setAttribute('type', 'button');
                $id = $this->getCollapse()->generateId();
                $toggle->setData('target', '#' . $id);
                $toggle->setData('toggle', 'collapse');
                $toggle->setAria('controls', $id);
                $toggle->setAria('expanded', 'false');
                $toggle->setAria('label', 'Toggle navigation');
                $toggle->push(new HtmlElement('span.navbar-toggler-icon'));
                $this->push($toggle);
            } else {
                $this->addOption('navbar-expand');
            }
            $this->push($this->getCollapse());
            if ($this->hasSearch()) {
                $form = new Form();
                if ($this->hasSearchAction()) {
                    $form->setAction($this->getSearchAction());
                }
                $form->addOption('order-3');
                $this->getSearch()->setRounded(Input::ROUNDED_NONE);
                if ($this->hasBackground()) {
                    $this->getSearch()->setBackground($this->getBackground());
                    $this->getSearch()->setColor($this->getContrast()->getColor($this->getBackground()));
                }
                $this->getSearch()->setBorder(Input::BORDER_SECONDARY);
                $form->push($this->getSearch());
                $this->getCollapse()->push($form);
            }
        }

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
        $brand->addOption('order-1');
        $this->getElementList()->unshift($brand);
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
