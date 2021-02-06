<?php


namespace Pars\Component\Base\Pagination;


use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldListAwareTrait;
use Pars\Mvc\View\HtmlElement;

class Pagination extends AbstractComponent
{
    use FieldListAwareTrait;

    protected function initialize()
    {
        $this->setTag('nav');
        $ul = new HtmlElement('ul.pagination');
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
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    public function addPrevious(string $path)
    {
        return $this->addPage($path, '&laquo;');
    }

    /**
     * @param string $path
     * @return PaginationItem
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    public function addNext(string $path)
    {
        return $this->addPage($path, '&raquo;');
    }

    /**
     * @param string $path
     * @param string|null $content
     * @return PaginationItem
     * @throws \Niceshops\Bean\Type\Base\BeanException
     */
    public function addPage(string $path, string $content = null, bool $active = false)
    {
        $item = new PaginationItem();
        $item->setActive($active);
        $item->push(new PaginationLink($path, $content));
        $this->getFieldList()->push($item);
        return $item;
    }
}
