<?php


namespace Pars\Component\Base\Form;


class Hidden extends Input
{

    /**
     * Hidden constructor.
     */
    public function __construct(string $name, string $value)
    {
        $this->setName($name);
        $this->setValue($value);
        parent::__construct();
    }

    protected function initialize()
    {
        $this->setType(self::TYPE_HIDDEN);
        parent::initialize();
    }


}
