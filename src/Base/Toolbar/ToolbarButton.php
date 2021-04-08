<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Bean\Type\Base\BeanException;
use Pars\Component\Base\Field\Button;

class ToolbarButton extends Button
{
    /**
     * ToolbarButton constructor.
     * @param string|null $path
     * @param string|null $content
     * @throws BeanException
     */
    public function __construct(?string $path = null, ?string $content= null)
    {
        parent::__construct($content, null, $path);
    }

    protected function initialize()
    {
        $this->addOption('my-2');
        parent::initialize();
    }

}
