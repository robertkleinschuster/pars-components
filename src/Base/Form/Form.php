<?php

namespace Pars\Component\Base\Form;

use Pars\Bean\Type\Base\BeanException;
use Pars\Component\Base\BackgroundAwareInterface;
use Pars\Component\Base\BackgroundAwareTrait;
use Pars\Component\Base\BorderAwareInterface;
use Pars\Component\Base\BorderAwareTrait;
use Pars\Component\Base\ColorAwareInterface;
use Pars\Component\Base\ColorAwareTrait;
use Pars\Component\Base\Field\Button;
use Pars\Component\Base\Form\Wysiwyg\Wysiwyg;
use Pars\Component\Base\Grid\Container;
use Pars\Component\Base\ShadowAwareInterface;
use Pars\Component\Base\ShadowAwareTrait;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\Event\ViewEvent;
use Pars\Mvc\View\ViewElement;
use Pars\Pattern\Exception\AttributeExistsException;
use Pars\Pattern\Exception\AttributeLockException;

/**
 * Class Form
 * @package Pars\Component\Base\Form
 */
class Form extends AbstractComponent implements BorderAwareInterface, BackgroundAwareInterface, ShadowAwareInterface, ColorAwareInterface
{
    use BorderAwareTrait;
    use BackgroundAwareTrait;
    use ShadowAwareTrait;
    use ColorAwareTrait;

    public const GROUP_LAST = 'last';
    public const METHOD_POST = 'post';
    public const METHOD_GET = 'get';
    /**
     * @var array
     */
    protected array $formGroupList = [];

    /**
     * @var string|null
     */
    public ?string $action = null;

    /**
     * @var string|null
     */
    public ?string $method = null;

    public bool $useColumns = true;

    /**
     * Form constructor.
     * @param string|null $action
     * @param string|null $method
     * @throws BeanException
     * @throws AttributeExistsException
     * @throws AttributeLockException
     */
    public function __construct(?string $action = null, ?string $method = null)
    {
        parent::__construct();
        $this->action = $action;
        $this->method = $method;
    }


    protected function initialize()
    {
        $this->setTag('form');
        if ($this->hasMethod()) {
            $this->setAttribute('method', $this->getMethod());
        } else {
            $this->setAttribute('method', self::METHOD_POST);
        }
        if ($this->hasAction()) {
            $this->setAttribute('action', $this->getAction());
        }
        $this->setAttribute('enctype', 'multipart/form-data');

        if ($this->hasBorder()) {
            $this->addOption('border');
            $this->addOption($this->getBorder());
        }
        if ($this->hasRounded()) {
            $this->addOption($this->getRounded());
        }
        if ($this->hasBorderPosition()) {
            $this->addOption($this->getBorderPosition());
        }
        if ($this->hasBackground()) {
            $this->addOption($this->getBackground());
        }
        if ($this->hasShadow()) {
            $this->addOption($this->getShadow());
        }
        if ($this->hasColor()) {
            $this->addOption($this->getColor());
        }
        $container = new Container();
        $container->setMode(Container::MODE_FLUID);
        $arrGroup_Field = [];
        foreach ($this->getFieldList() as $field) {
            if ($field->hasGroup()) {
                $arrGroup_Field[$field->getGroup()][] = $field;
            } else {
                $arrGroup_Field[''][] = $field;
            }
        }

        $rowLast = new FormRow();
        if (isset($arrGroup_Field[self::GROUP_LAST])) {
            foreach ($arrGroup_Field[self::GROUP_LAST] as $field) {
                $column = new FormColumn();
                $column->push($field);
                $rowLast->push($column);
            }
            unset($arrGroup_Field[self::GROUP_LAST]);
        }

        foreach ($arrGroup_Field as $group => $groupFieldList) {
            if ($group) {
                $title = new FormRow();
                $title->addOption('fw-bold');
                $title->addOption('mt-3');
                $title->setContent($group . '<hr>');
                $container->push($title);
                $row = new FormRow();
                // intentionally no break to set breakpoints up to the field count
                $groupFieldCount = count($groupFieldList);
                $groupFieldCount = $groupFieldCount > 4 ? 4 : $groupFieldCount;
                switch ($groupFieldCount) {
                    case 4:
                        $row->addOption('row-cols-lg-4');
                    case 3:
                        $row->addOption('row-cols-md-3');
                    case 2:
                        $row->addOption('row-cols-sm-2');
                    case 1:
                        $row->addOption('row-cols-1');
                }
                foreach ($groupFieldList as $field) {
                    $column = new FormColumn();
                    $column->push($field);
                    $row->push($column);
                }
                $container->push($row);
            } else {
                $row = new FormRow();
                // intentionally no break to set breakpoints up to the field count
                $groupFieldCount = count($groupFieldList);
                $groupFieldCount = $groupFieldCount > 4 ? 4 : $groupFieldCount;
                if ($this->isUseColumns()) {
                    switch ($groupFieldCount) {
                        case 4:
                            $row->addOption('row-cols-lg-4');
                        case 3:
                            $row->addOption('row-cols-md-3');
                        case 2:
                            $row->addOption('row-cols-sm-2');
                        case 1:
                            $row->addOption('row-cols-1');
                    }
                }
                foreach ($groupFieldList as $field) {
                    if (!$this->isUseColumns()) {
                        $row = new FormRow();
                        $container->push($row);
                    }
                    $column = new FormColumn();
                    $column->push($field);
                    $row->push($column);

                }
                if ($this->isUseColumns()) {

                $container->push($row);
                }
            }
        }
        $container->push($rowLast);
        $this->push($container);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addText(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Input(Input::TYPE_TEXT), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addHidden(string $name, string $value = null)
    {
        $input = new Input(Input::TYPE_HIDDEN);
        $input->setName($name);
        if ($value) {
            $input->setValue($value);
        }
        $this->push($input);
        return $input;
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addTextarea(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Textarea(), $name, $value, $label);
    }


    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addWysiwyg(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Wysiwyg(), $name, $value, $label)->setFloating(false);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addEmail(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Input(Input::TYPE_EMAIL), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addPassword(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Input(Input::TYPE_PASSWORD), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addTel(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Input(Input::TYPE_TEL), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addUrl(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Input(Input::TYPE_URL), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addFile(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new File(), $name, $value, $label);
    }


    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addDate(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Date(), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addTime(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Time(), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addDateTime(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new DateTimeLocal(), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param array $options
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    public function addSelect(string $name, array $options, string $value = '', string $label = null)
    {
        return $this->addInput(new Select($options), $name, $value, $label);
    }


    /**
     * @param string $name
     * @param array $options
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    public function addFileSelect(string $name, FileSelect $fileSelect, string $value = null, string $label = null)
    {
        return $this->addInput($fileSelect, $name, $value, $label);
    }

    /**
     * @param string $name
     * @param array $options
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    public function addRadioGroup(string $name, array $options, string $value = null, string $label = null)
    {
        return $this->addInput(new RadioGroup($options), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    public function addCheckbox(string $name, string $value = null, string $label = null)
    {
        return $this->addInput(new Checkbox(), $name, $value, $label);
    }

    /**
     * @param string $name
     * @param string $content
     * @param string|null $value
     * @param string|null $style
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    public function addSubmit(string $name, string $content, string $value = null, string $style = null, string $label = null)
    {
        $submit = new Submit($content, $style ?? Submit::STYLE_WARNING);
        $path = null;
        if ($this->hasAction()) {
            $path = $this->getAction();
        }
        $submit->setEvent(ViewEvent::createSubmit($path, $this->generateId()));
        return $this->addInput($submit, $name, $value, $label)->setFloating(false)
            ->setGroup(self::GROUP_LAST);
    }

    /**
     * @param string $name
     * @param string $content
     * @param string|null $value
     * @param string|null $style
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    public function addReset(string $name, string $content, string $value = null, string $style = null, string $label = null)
    {
        return $this->addInput(new Reset($content, $style ?? Reset::STYLE_SECONDARY), $name, $value, $label)->setFloating(false)
            ->setGroup(self::GROUP_LAST);
    }

    /**
     * @param string $label
     * @param string $path
     */
    public function addCancel(string $label, string $path)
    {
        $button = new Button();
        $button->setStyle(Button::STYLE_SECONDARY);
        $button->setContent($label);
        $button->setPath($path);
        $button->addOption('close-modal');
        $button->addOption('w-100');
        $button->setEvent(ViewEvent::createLink($path));
        $formGroup = new FormGroup('cancel');
        $formGroup->push($button);
        $formGroup->setFloating(false);
        $formGroup->setGroup(self::GROUP_LAST);
        $this->pushField($formGroup);
    }


    /**
     * @param Input $input
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    protected function addInput(
        Input $input,
        string $name,
        string $value = null,
        string $label = null
    )
    {
        $formGroup = new FormGroup($name);
        if (null !== $value) {
            $formGroup->setValue($value);
        }
        if (null !== $label) {
            $formGroup->setLabel($label);
        }
        $formGroup->setInput($input);
        if ($input instanceof Button || $input instanceof Wysiwyg) {
            $formGroup->setFloating(false);
        }
        $this->addFormGroup($formGroup);
        return $formGroup;
    }

    /**
     * @param FormGroup $formGroup
     * @param int $row
     * @param int $column
     */
    protected function addFormGroup(FormGroup $formGroup)
    {
        $this->formGroupList[] = $formGroup;
        $this->pushField($formGroup);
        return $this;
    }

    /**
     * @return array
     */
    public function getFormGroupList(): array
    {
        return $this->formGroupList;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @param string $action
     *
     * @return $this
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAction(): bool
    {
        return isset($this->action);
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     *
     * @return $this
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasMethod(): bool
    {
        return isset($this->method);
    }

    /**
     * @return bool
     */
    public function isUseColumns(): bool
    {
        return $this->useColumns;
    }

    /**
     * @param bool $useColumns
     * @return Form
     */
    public function setUseColumns(bool $useColumns): Form
    {
        $this->useColumns = $useColumns;
        return $this;
    }



}
