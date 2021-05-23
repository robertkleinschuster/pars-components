<?php


namespace Pars\Component\Base\Form\Wysiwyg;


use Pars\Bean\Type\Base\AbstractBaseBean;

class Action extends AbstractBaseBean
{
     public ?string $title = null;
     public ?string $name = null;
     public ?string $icon = null;
     public ?string $command = null;
     public ?string $commandValue = null;
     public ?ActionList $dropdown = null;

    /**
     * @return ActionList|null
     */
    public function getDropdown(): ?ActionList
    {
        if (!isset($this->dropdown)) {
            $this->dropdown = new ActionList();
        }
        return $this->dropdown;
    }

}
