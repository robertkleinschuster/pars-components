<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractField;
use Pars\Mvc\View\HtmlElement;

class Item extends AbstractField
{
    public bool $active = false;

    public ?string $hint = null;

    private ?Link $link = null;

    protected function initialize()
    {
        $this->setTag('li');
        $this->addOption('nav-item');
        $this->getLink()->setActive($this->isActive());
        if ($this->hasHint()) {
            $small = new HtmlElement('small', $this->getHint() . ' ');
            $small->addOption('text-secondary');
            $this->getLink()->push($small);
        }
        if ($this->hasContent()) {
            $this->getLink()->push(new HtmlElement('span', $this->getContent()));
            $this->set('content', null);
        }
        if ($this->hasPath()) {
            $this->getLink()->setPath($this->getPath());
            $this->set('path', null);
        }
        $this->push($this->getLink());
    }

    /**
     * @return Link|null
     */
    public function getLink(): ?Link
    {
        if (null === $this->link) {
            $this->link = new Link();
        }
        return $this->link;
    }

    /**
     * @param Link|null $link
     * @return Item
     */
    public function setLink(?Link $link): Item
    {
        $this->link = $link;
        return $this;
    }


    /**
     * @return string
     */
    public function getHint(): string
    {
        return $this->hint;
    }

    /**
     * @param string $hint
     *
     * @return $this
     */
    public function setHint(string $hint): self
    {
        $this->hint = $hint;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasHint(): bool
    {
        return isset($this->hint);
    }


    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     * @return Item
     */
    public function setActive(bool $active): Item
    {
        $this->active = $active;
        return $this;
    }


}
