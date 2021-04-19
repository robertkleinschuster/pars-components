<?php


namespace Pars\Component\Base\Edit;


use Pars\Bean\Type\Base\BeanAwareInterface;
use Pars\Bean\Type\Base\BeanAwareTrait;
use Pars\Component\Base\Form\Form;
use Pars\Mvc\View\AbstractComponent;

class Edit extends AbstractComponent implements BeanAwareInterface
{
    use BeanAwareTrait;

    private ?Form $form = null;

    protected function initialize()
    {
        parent::initialize();
        $this->initForm();
        $this->handleForm();
    }

    protected function initForm()
    {

    }

    protected function handleForm()
    {
        $this->getMain()->push($this->getForm());
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
