<?php

namespace Pars\Component\Base\Overview;

use Pars\Bean\Type\Base\BeanListAwareTrait;
use Pars\Component\Base\Field\Span;
use Pars\Component\Base\Table\Table;
use Pars\Component\Base\Table\TableResponsive;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\FieldAcceptInterface;
use Pars\Mvc\View\FieldInterface;
use Pars\Mvc\View\Event\ViewEvent;

class Overview extends AbstractComponent
{
    use BeanListAwareTrait;

    public ?string $detailPath = null;
    public ?string $editPath = null;
    public ?string $deletePath = null;
    public ?string $moveDownPath = null;
    public ?string $moveUpPath = null;
    public ?string $bulkFieldName = null;
    public ?string $bulkFieldValue = null;
    public ?FieldAcceptInterface $showEditAccept = null;

    public array $fields = [];

    private ?TableResponsive $table = null;


    protected function handleFields()
    {
        parent::handleFields();
        $this->handleTable();
        $this->handleMoveUpButton();
        $this->handleMoveDownButton();
        $this->handleDeleteButton();
        $this->handleEditButton();
        $this->handleDetailButton();
        $this->handleBulkField();
        foreach ($this->fields as $name => $label) {
            $span = new Span("{{$name}}", $label);
            if ($this->hasDetailPath()) {
                $span->setPath($this->getDetailPath());
                $span->addOption(Span::OPTION_DECORATION_NONE);
            }
            $this->pushField($span);
        }
    }


    protected function handleBulkField()
    {
        if ($this->hasBulkField()) {
            $check = new BulkCheckbox();
            $check->setName($this->getBulkFieldName());
            $check->setValue($this->getBulkFieldValue());
            $this->unshiftField($check);
        }
    }

    protected function handleDetailButton()
    {
        if ($this->hasDetailPath()) {
            $button = new DetailButton($this->getDetailPath());
            $button->setEvent(ViewEvent::createLink($this->getDetailPath()));
            $this->unshiftField($button);
        }
    }

    protected function handleTable()
    {
        if ($this->hasBeanList()) {
            $this->getTableResponsive()->setBeanList($this->getBeanList());
        }
        $this->getTable()->setFieldList($this->getFieldList());
        $this->getMain()->push($this->getTableResponsive());
    }

    protected function handleMoveUpButton()
    {
        if ($this->hasMoveUpPath()) {
            $button = new MoveUpButton($this->getMoveUpPath());
            $button->setEvent(ViewEvent::createLink($this->getMoveUpPath(), false));
            $button->getEvent()->setTargetId($this->generateId());
            $this->unshiftField($button);
        }

    }

    protected function handleMoveDownButton()
    {
        if ($this->hasMoveDownPath()) {
            $button = new MoveDownButton($this->getMoveDownPath());
            $button->setEvent(ViewEvent::createLink($this->getMoveDownPath(), false));
            $button->getEvent()->setTargetId($this->generateId());
            $this->unshiftField($button);
        }
    }

    protected function handleAdditionalBefore()
    {
        parent::handleAdditionalBefore();

    }


    protected function handleAdditionalAfter()
    {
        parent::handleAdditionalAfter();
    }

    /**
     * @return EditButton
     */
    protected function handleEditButton(): EditButton
    {
        $button = (new EditButton())->setModal(true);
        if ($this->hasShowEditFieldAccept()) {
            $button->setAccept($this->getShowEditFieldAccept());
        }
        if ($this->hasEditPath()) {
            $button->setPath($this->getEditPath());
            $button->setEvent(ViewEvent::createLink($this->getEditPath()));
            $this->unshiftField($button);
        }
        return $button;
    }

    /**
     * @return DeleteButton
     */
    protected function handleDeleteButton(): DeleteButton
    {
        $button = (new DeleteButton())->setModal(true);
        if ($this->hasDeletePath()) {
            $button->setPath($this->getDeletePath());
            $button->setEvent(ViewEvent::createLink($this->getDeletePath()));
            $this->unshiftField($button);
        }
        return $button;
    }

    /**
     * @return string
     */
    public function getBulkFieldName(): string
    {
        return $this->bulkFieldName;
    }

    /**
     * @param string $bulkFieldName
     *
     * @return $this
     */
    public function setBulkFieldName(string $bulkFieldName): self
    {
        $this->bulkFieldName = $bulkFieldName;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasBulkField(): bool
    {
        return isset($this->bulkFieldName) && isset($this->bulkFieldValue);
    }

    /**
     * @return string|null
     */
    public function getBulkFieldValue(): ?string
    {
        return $this->bulkFieldValue;
    }

    /**
     * @param string|null $bulkFieldValue
     */
    public function setBulkFieldValue(?string $bulkFieldValue): void
    {
        $this->bulkFieldValue = $bulkFieldValue;
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
     * @param string $label
     */
    public function addFieldSpan(string $name, string $label)
    {
        $span = new Span("{{$name}}", $label);
        if ($this->hasDetailPath()) {
            $span->setPath($this->getDetailPath());
            $span->addOption(Span::OPTION_DECORATION_NONE);
        }
        $this->pushField($span);
        return $span;
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


    /**
     * @return FieldAcceptInterface
     */
    public function getShowEditFieldAccept(): FieldAcceptInterface
    {
        return $this->showEditAccept;
    }

    /**
     * @param FieldAcceptInterface $showEditAccept
     *
     * @return $this
     */
    public function setShowEditFieldAccept(FieldAcceptInterface $showEditAccept): self
    {
        $this->showEditAccept = $showEditAccept;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasShowEditFieldAccept(): bool
    {
        return isset($this->showEditAccept);
    }

}
