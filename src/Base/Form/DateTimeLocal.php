<?php


namespace Pars\Component\Base\Form;


class DateTimeLocal extends Input
{
    public const FORMAT = 'Y-m-d\TH:i:s';

    /**
     * DateTimeLocal constructor.
     * @param \DateTime|null $dateTime
     */
    public function __construct(\DateTime $dateTime = null)
    {
        parent::__construct();
        if (null !== $dateTime) {
            $this->setDateTime($dateTime);
        }
    }


    protected function initialize()
    {
        $this->setType(self::TYPE_DATETIME_LOCAL);
        parent::initialize();
    }

    /**
     * @param \DateTime $dateTime
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->setValue($dateTime->format(self::FORMAT));
    }
}

