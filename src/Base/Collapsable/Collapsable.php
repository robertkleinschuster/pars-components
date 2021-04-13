<?php


namespace Pars\Component\Base\Collapsable;

use Pars\Component\Base\Field\Span;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\ComponentGroup;
use Pars\Mvc\View\ComponentInterface;
use Pars\Mvc\View\HtmlElement;

class Collapsable extends AbstractComponent
{
    protected ?ComponentGroup $componentGroup = null;
    protected bool $expanded = false;
    protected string $title = "";
    protected ?ToggleCollapsableButton $button = null;

    protected function initialize()
    {
        parent::initialize();
        $this->initCollapsableHeader();
        $this->initCollapsableContent();
    }

    protected function initCollapsableContent()
    {
        $content = $this->getComponentGroup();
        $content->addOption("collapse");
        if($this->isExpanded()) {
           $content->addOption("show");
        }
        $this->push($content);
    }

    protected function initCollapsableHeader()
    {
        $header = new HtmlElement();
        $header->addOption("d-flex");
        $header->addOption("justify-content-between");
        $header->addOption("mb-2");

        $button = $this->getButton();
        $button->setToggle($this->isExpanded());

        $title = new Span();
        $title->addOption("my-auto");
        $title->setContent($this->getTitle());

        $header->push($title);
        $header->push($button);
        $this->push($header);
    }

    /**
     * @return ToggleCollapsableButton
     */
    public function getButton(): ?ToggleCollapsableButton
    {
        if(!isset($this->button)) {
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