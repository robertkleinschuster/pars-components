<?php
namespace Pars\Component\Base\Detail;

use Niceshops\Bean\Type\Base\BeanAwareTrait;
use Niceshops\Bean\Type\Base\BeanInterface;
use Pars\Component\Base\Jumbotron\Jumbotron;
use Pars\Mvc\View\AbstractComponent;

class Detail extends AbstractComponent
{
    use BeanAwareTrait;

    private ?Jumbotron $jumbotron = null;

    protected function initialize()
    {
        $this->push($this->getJumbotron());
    }

    public function render(BeanInterface $bean = null): string
    {
        if ($this->hasBean()) {
            $bean = $this->getBean();
        }
        return parent::render($bean);
    }

    /**
     * @return Jumbotron|null
     */
    public function getJumbotron(): ?Jumbotron
    {
        if (null === $this->jumbotron) {
            $this->jumbotron = new Jumbotron();
        }
        return $this->jumbotron;
    }

    /**
     * @param Jumbotron|null $jumbotron
     * @return Detail
     */
    public function setJumbotron(?Jumbotron $jumbotron): Detail
    {
        $this->jumbotron = $jumbotron;
        return $this;
    }


}
