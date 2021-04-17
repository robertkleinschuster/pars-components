<?php


namespace Pars\Component\Base\Collapsable;

use Pars\Component\Base\Field\Span;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ComponentGroup;
use Pars\Mvc\View\ComponentInterface;
use Pars\Mvc\View\Event\ViewEvent;
use Pars\Mvc\View\HtmlElement;
use Pars\Mvc\View\State\ViewState;

class Collapsable extends AbstractComponent
{
    protected ?ComponentGroup $componentGroup = null;
    protected bool $expanded = false;
    protected string $title = "";
    protected ?ToggleCollapsableButton $button = null;



    protected function initialize()
    {
        parent::initialize();
        if ($this->getButton()->hasPath() && $this->hasId()) {
            $this->setState(new ViewState($this->getId()));
            $this->setExpanded($this->getState()->get('expanded', $this->isExpanded()));
            $this->getButton()->setEvent(ViewEvent::createCallback($this->getButton()->getPath(), $this->getId(),
                function (){
                    $expanded = !$this->getState()->get('expanded', $this->isExpanded());
                    $this->getState()->set('expanded', $expanded);
                    $this->initExpanded($expanded);
            }));
        }
        $this->initCollapsableHeader();
        $this->initCollapsableContent();
        $this->initExpanded($this->isExpanded());
    }

    protected function initCollapsableContent()
    {
        $content = $this->getComponentGroup();
        $content->addOption("collapse");
        $this->push($content);
    }

    protected function initCollapsableHeader()
    {
        $header = new HtmlElement();
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
