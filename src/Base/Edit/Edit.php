<?php


namespace Pars\Component\Base\Edit;


use Niceshops\Bean\Type\Base\BeanAwareTrait;
use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Component\Base\Form\Form;
use Pars\Mvc\View\AbstractComponent;

class Edit extends AbstractComponent
{
    use BeanAwareTrait;

    private ?Form $form = null;

    protected function initialize()
    {
        $this->push($this->getForm());
    }


    public function render(BeanInterface $bean = null): string
    {
        if ($this->hasBean()) {
            $bean = $this->getBean();
        }
        return parent::render($bean);
    }

    /**
     * @return Form|null
     */
    public function getForm(): ?Form
    {
        if (null === $this->form) {
            $this->form = new Form();
        }
        return $this->form;
    }

    /**
     * @param Form|null $form
     * @return Edit
     */
    public function setForm(?Form $form): Edit
    {
        $this->form = $form;
        return $this;
    }


}
