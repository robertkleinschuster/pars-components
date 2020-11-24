<?php


namespace Pars\Component\Base\Form;


class Date extends Input
{


    /**
     * Date constructor.
     * @param \DateTime|null $date
     */
    public function __construct(\DateTime $date = null)
    {
        parent::__construct();
        if ($date !== null) {
            $this->setDate($date);
        }
    }

    protected function initialize()
    {
        $this->setType(self::TYPE_DATE);
        parent::initialize();
    }

    /**
     * @param \DateTime $date
     */
    public function setDate(\DateTime $date)
    {
        $this->setValue($date->format('Y-m-d'));
        return $this;
    }
}
