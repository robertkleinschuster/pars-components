<?php


namespace Pars\Component\Base\Form;


class Time extends Input
{
    public function __construct(\DateTime $time = null)
    {
        parent::__construct();
        if (null !== $time) {
            $this->setTime($time);
        }
    }


    protected function initialize()
    {
        $this->setType(self::TYPE_TIME);
        parent::initialize();
    }

    /**
     * @param \DateTime $time
     * @return $this
     */
    public function setTime(\DateTime $time)
    {
        $this->setValue($time->format('H:i'));
        return $this;
    }
}
