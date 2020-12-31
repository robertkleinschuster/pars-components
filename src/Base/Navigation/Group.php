<?php


namespace Pars\Component\Base\Navigation;


use Pars\Mvc\View\AbstractComponent;

class Group extends AbstractComponent
{
    public bool $right = false;

    protected function initialize()
    {
        $this->setTag('ul');
        $this->addOption('navbar-nav');
        if (!$this->isRight()) {
            $this->addOption('mr-auto');
        }
    }

    /**
     * @return bool
     */
    public function isRight(): bool
    {
        return $this->right;
    }

    /**
     * @param bool $right
     * @return Group
     */
    public function setRight(bool $right): Group
    {
        $this->right = $right;
        return $this;
    }


}
