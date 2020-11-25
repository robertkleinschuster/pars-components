<?php

namespace Pars\Component\Base\Overview;

use Niceshops\Bean\Type\Base\BeanListAwareTrait;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Table\Table;
use Pars\Component\Base\Table\TableResponsive;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldInterface;

class Overview extends AbstractComponent
{
    use BeanListAwareTrait;

    public ?string $detailPath = null;
    public ?string $editPath = null;
    public ?string $deletePath = null;
    public ?string $moveDownPath = null;
    public ?string $moveUpPath = null;

    public array $fields = [];

    private ?TableResponsive $table = null;

    protected function initialize()
    {
        if ($this->hasBeanList()) {
            $this->getTableResponsive()->setBeanList($this->getBeanList());
        }
        $this->push($this->getTableResponsive());
        if ($this->hasMoveUpPath()) {
            $this->prepend(new MoveUpButton($this->getMoveUpPath()));
        }
        if ($this->hasMoveDownPath()) {
            $this->prepend(new MoveDownButton($this->getMoveDownPath()));
        }
        if ($this->hasDeletePath()) {
            $this->prepend(new DeleteButton($this->getDeletePath()));
        }
        if ($this->hasEditPath()) {
            $this->prepend(new EditButton($this->getEditPath()));
        }
        if ($this->hasDetailPath()) {
            $this->prepend(new DetailButton($this->getDetailPath()));
        }
        foreach ($this->fields as $name => $label) {
            $span = new Span("{{$name}}", $label);
            if ($this->hasDetailPath()) {
                $span->setPath($this->getDetailPath());
                $span->addOption(Span::OPTION_DECORATION_NONE);
            }
            $this->append($span);
        }
    }

    /**
     * @return Table|null
     */
    public function getTableResponsive(): ?TableResponsive
    {
        if (null === $this->table) {
            $this->table = new TableResponsive();
        }
        return $this->table;
    }

    public function getTable(): Table
    {
        return $this->getTableResponsive()->getTable();
    }

    /**
     * @param FieldInterface $field
     * @return $this
     */
    public function append(FieldInterface $field)
    {
        $this->getTable()->getFieldList()->push($field);
        return $this;
    }

    /**
     * @param FieldInterface $field
     * @return $this
     */
    public function prepend(FieldInterface $field)
    {
        $this->getTable()->getFieldList()->unshift($field);
        return $this;
    }

    /**
     * @return string
     */
    public function getDetailPath(): string
    {
        return $this->detailPath;
    }

    /**
     * @param string $detailPath
     *
     * @return $this
     */
    public function setDetailPath(string $detailPath): self
    {
        $this->detailPath = $detailPath;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDetailPath(): bool
    {
        return isset($this->detailPath);
    }

    /**
     * @return string
     */
    public function getEditPath(): string
    {
        return $this->editPath;
    }

    /**
     * @param string $editPath
     *
     * @return $this
     */
    public function setEditPath(string $editPath): self
    {
        $this->editPath = $editPath;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasEditPath(): bool
    {
        return isset($this->editPath);
    }

    /**
     * @return string
     */
    public function getDeletePath(): string
    {
        return $this->deletePath;
    }

    /**
     * @param string $deletePath
     *
     * @return $this
     */
    public function setDeletePath(string $deletePath): self
    {
        $this->deletePath = $deletePath;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasDeletePath(): bool
    {
        return isset($this->deletePath);
    }

    /**
     * @return string
     */
    public function getMoveUpPath(): string
    {
        return $this->moveUpPath;
    }

    /**
     * @param string $moveUpPath
     *
     * @return $this
     */
    public function setMoveUpPath(string $moveUpPath): self
    {
        $this->moveUpPath = $moveUpPath;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasMoveUpPath(): bool
    {
        return isset($this->moveUpPath);
    }

    /**
     * @return string
     */
    public function getMoveDownPath(): string
    {
        return $this->moveDownPath;
    }

    /**
     * @param string $moveDownPath
     *
     * @return $this
     */
    public function setMoveDownPath(string $moveDownPath): self
    {
        $this->moveDownPath = $moveDownPath;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasMoveDownPath(): bool
    {
        return isset($this->moveDownPath);
    }

    /**
     * @param string $name
     * @param string $label
     */
    public function addField(string $name, string $label)
    {
        $this->fields[$name] = $label;
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function removeField(string $name)
    {
        unset($this->fields[$name]);
        return $this;
    }
}
