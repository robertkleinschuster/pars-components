<?php


namespace Pars\Component\Base\Pagination;


use Pars\Mvc\View\Event\ViewEvent;
use Pars\Mvc\View\ViewElement;

class PaginationLink extends ViewElement
{
    public function __construct(?string $path, string $content)
    {
        parent::__construct('a', $content, null, $path);
    }

    protected function initialize()
    {
        if ($this->hasPath()) {
            $this->setTag('a');
        }
        $this->addOption('page-link');
        $this->setAttribute('href', $this->getPath());
        $this->setPath(null);
        parent::initialize();
    }

}
