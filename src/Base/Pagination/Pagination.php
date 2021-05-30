<?php


namespace Pars\Component\Base\Pagination;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\Event\ViewEvent;
use Pars\Mvc\View\FieldListAwareTrait;
use Pars\Mvc\View\ViewElement;

class Pagination extends AbstractComponent
{
    protected function initialize()
    {
        $this->setTag('nav');
        $ul = new ViewElement('ul.pagination.pagination-sm');
        foreach ($this->getFieldList() as $item) {
            $ul->push($item);
        }
        $this->push($ul);
        parent::initialize();
    }

    /**
     * @param PaginationItem $item
     * @return $this
     */
    public function addItem(PaginationItem  $item)
    {
        $this->getFieldList()->push($item);
        return $this;
    }

    /**
     * @param string $path
     * @return PaginationItem
     * @throws \Pars\Bean\Type\Base\BeanException
     */
    public function addPrevious(string $path)
    {
        return $this->addPage($path, '&laquo;');
    }

    /**
     * @param string $path
     * @return PaginationItem
     * @throws \Pars\Bean\Type\Base\BeanException
     */
    public function addNext(string $path)
    {
        return $this->addPage($path, '&raquo;');
    }

    /**
     * @param string $path
     * @param string|null $content
     * @return PaginationItem
     * @throws \Pars\Bean\Type\Base\BeanException
     */
    public function addPage(?string $path, string $content = null, bool $active = false)
    {
        $item = new PaginationItem();
        $item->setActive($active);
        $event = ViewEvent::createLink($path, false);
        $item->setEvent($event);
        $item->push(new PaginationLink($path, $content));
        $this->getFieldList()->push($item);
        return $item;
    }
}

