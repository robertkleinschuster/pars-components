<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Mvc\View\AbstractComponent;


class Toolbar extends AbstractComponent
{
    public ?string $createPath = null;

    protected function initialize()
    {
        if ($this->hasCreatePath()) {
            $this->getElementList()->unshift(new CreateButton($this->getCreatePath()));
        }
        $this->addOption('btn-toolbar');
        $this->addOption('mb-4');
        parent::initialize();
    }


    /**
     * @return string
     */
    public function getCreatePath(): string
    {
        return $this->createPath;
    }

    /**
     * @param string $createPath
     *
     * @return $this
     */
    public function setCreatePath(string $createPath): self
    {
        $this->createPath = $createPath;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCreatePath(): bool
    {
        return isset($this->createPath);
    }


}
