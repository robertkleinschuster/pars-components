<?php


namespace Pars\Component\Base\Collapsable;

use Pars\Component\Base\Field\Span;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ComponentGroup;
use Pars\Mvc\View\ComponentInterface;
use Pars\Mvc\View\Event\ViewEvent;
use Pars\Mvc\View\ViewElement;
use Pars\Mvc\View\State\ViewState;

class Collapsable extends AbstractComponent
{
    public function __construct(string $id = null, string $path = null, string $title = null)
    {
        parent::__construct();
        if ($id) {
            $this->setId($id);
        }
        if ($path) {
            $this->getButton()->setPath($path);
        }
        if ($title) {
            $this->setTitle($title);
        }
    }


    protected ?ComponentGroup $componentGroup = null;
    protected bool $expanded = false;
    protected string $title = "";
    protected ?ToggleCollapsableButton $button = null;

    protected function initialize()
    {
        parent::initialize();
        $this->initCollapsableHeader();
        $this->initCollapsableContent();
        $this->initExpanded($this->isExpanded());
    }

    protected function initEvent()
    {
        parent::initEvent();
        if ($this->getButton()->hasPath() && $this->hasId()) {
            $this->setState(new ViewState($this->getId()));
            $this->setExpanded($this->getState()->get('expanded', $this->isExpanded()));
            $event = ViewEvent::createCallback(function ($element) {
                $expanded = !$this->getState()->get('expanded', $this->isExpanded());
                $element->getState()->set('expanded', $expanded);
                $element->setExpanded($expanded);
            }, $this->getButton()->getPath());
            $event->setDelegate('button');
            $event->setTargetId($this->getId());
            $this->setEvent($event);
        }
    }


    protected function initCollapsableContent()
    {
        $content = $this->getComponentGroup();
        $content->addOption("collapse");
    }

    protected function initCollapsableHeader()
    {
        $header = new ViewElement();
        $header->addOption("d-flex");
        $header->addOption("justify-content-between");
        $header->addOption("mb-2");

        $button = $this->getButton();

        $title = new Span();
        $title->addOption("my-auto");
        $title->setContent($this->getTitle());
        if ($button->hasPath()) {
            $title->setPath($button->getPath());
        }
        $header->push($title);
        $header->push($button);
        $this->push($header);
    }

    protected function initExpanded(bool $expanded)
    {
        $this->getButton()->setToggle($expanded);
        if ($expanded) {
            $this->push($this->getComponentGroup());
            $this->getComponentGroup()->addOption("show");
        } else {
            $this->getComponentGroup()->removeOption("show");
        }
    }

    /**
     * @return ToggleCollapsableButton
     */
    public function getButton(): ?ToggleCollapsableButton
    {
        if (!isset($this->button)) {
            $this->button = new ToggleCollapsableButton($this->getComponentGroup()->generateId());
        }
        return $this->button;
    }

    /**
     * @return ComponentGroup
     */
    protected function getComponentGroup(): ComponentGroup
    {
        if (!isset($this->componentGroup)) {
            $this->componentGroup = new ComponentGroup();
        }
        return $this->componentGroup;
    }

    /**
     * @return self
     */
    public function pushComponent(ComponentInterface ...$component): self
    {
        $this->getComponentGroup()->getComponentList()->push(...$component);
        return $this;
    }

    /**
     * @return bool
     */
    public function isExpanded(): bool
    {
        return $this->expanded;
    }

    /**
     * @param bool $expanded
     */
    public function setExpanded(bool $expanded): self
    {
        $this->expanded = $expanded;
        return $this;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

}
