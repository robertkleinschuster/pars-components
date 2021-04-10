<?php


namespace Pars\Component\Base\Form;


use Pars\Component\Base\BackgroundAwareInterface;
use Pars\Component\Base\BackgroundAwareTrait;
use Pars\Component\Base\BorderAwareInterface;
use Pars\Component\Base\BorderAwareTrait;
use Pars\Component\Base\ColorAwareInterface;
use Pars\Component\Base\ColorAwareTrait;
use Pars\Component\Base\Field\Button;
use Pars\Component\Base\ShadowAwareInterface;
use Pars\Component\Base\ShadowAwareTrait;
use Pars\Mvc\View\AbstractComponent;
use Pars\Mvc\View\HtmlInterface;

class Form extends AbstractComponent implements BorderAwareInterface, BackgroundAwareInterface, ShadowAwareInterface, ColorAwareInterface
{
    use BorderAwareTrait;
    use BackgroundAwareTrait;
    use ShadowAwareTrait;
    use ColorAwareTrait;

    public const METHOD_POST = 'post';
    public const METHOD_GET = 'get';

    /**
     * @var FormRow[]
     */
    protected array $rowMap = [];
    /**
     * @var FormColumn[]
     */
    protected array $columnMap = [];

    /**
     * @var array
     */
    protected array $formGroupList = [];

    public ?string $action = null;

    public ?string $method = null;

    /**
     * Form constructor.
     * @param string|null $action
     * @param string|null $method
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
        ksort($this->columnMap);
        foreach ($this->columnMap as $row => $columns) {
            ksort($columns);
            $formRow = $this->getRow($row);
            foreach ($columns as $column) {
                $formRow->push($column);
            }
            $this->push($formRow);
        }
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
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addText(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Input(Input::TYPE_TEXT), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addHidden(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Input(Input::TYPE_HIDDEN), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addTextarea(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Textarea(), $name, $value, $label, $row, $column);
    }


    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addWysiwyg(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Wysiwyg(), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addEmail(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Input(Input::TYPE_EMAIL), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addPassword(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Input(Input::TYPE_PASSWORD), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addTel(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Input(Input::TYPE_TEL), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addUrl(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Input(Input::TYPE_URL), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addFile(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new File(), $name, $value, $label, $row, $column);
    }


    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addDate(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Date(), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addTime(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Time(), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     */
    public function addDateTime(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new DateTimeLocal(), $name, $value, $label, $row, $column);
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
    public function addSelect(string $name, array $options, string $value = '', string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Select($options), $name, $value, $label, $row, $column);
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
    public function addFileSelect(string $name, FileSelect $fileSelect, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput($fileSelect, $name, $value, $label, $row, $column);
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
    public function addRadioGroup(string $name, array $options, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new RadioGroup($options), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $name
     * @param string|null $value
     * @param string|null $label
     * @param int $row
     * @param int $column
     * @return FormGroup
     */
    public function addCheckbox(string $name, string $value = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Checkbox(), $name, $value, $label, $row, $column);
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
    public function addSubmit(string $name, string $content, string $value = null, string $style = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Submit($content, $style ?? Submit::STYLE_PRIMARY), $name, $value, $label, $row, $column);
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
    public function addReset(string $name, string $content, string $value = null, string $style = null, string $label = null, int $row = 1, int $column = 1)
    {
        return $this->addInput(new Reset($content, $style ?? Reset::STYLE_DANGER), $name, $value, $label, $row, $column);
    }

    /**
     * @param string $label
     * @param string $path
     */
    public function addCancel(string $label, string $path, int $row = 1, int $column = 1)
    {
        $button = new Button();
        $button->setStyle(Button::STYLE_SECONDARY);
        $button->setContent($label);
        $button->setPath($path);
        $button->addOption('cache');
        $button->addOption('close-modal');
        $button->addOption('form-control');
        $formGroup = new FormGroup('cancel');
        $formGroup->push($button);
        $this->addElement($formGroup, $row, $column);
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
        string $label = null,
        int $row = 1,
        int $column = 1
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
        $this->addFormGroup($formGroup, $row, $column);
        return $formGroup;
    }

    public function addElement(HtmlInterface $html, int $row, int $column)
    {
        $formCol = $this->getColumn($row, $column);
        $formCol->push($html);
        $formCol->setBreakpoint(FormColumn::BREAKPOINT_MEDIUM);
    }

    /**
     * @param FormGroup $formGroup
     * @param int $row
     * @param int $column
     */
    protected function addFormGroup(FormGroup $formGroup, int $row = 1, int $column = 1)
    {
        $this->formGroupList[] = $formGroup;
        $this->addElement($formGroup, $row, $column);
        return $this;
    }

    /**
     * @return array
     */
    public function getFormGroupList(): array
    {
        return $this->formGroupList;
    }


    protected function getRow(int $row)
    {
        if (!isset($this->rowMap[$row])) {
            $this->rowMap[$row] = new FormRow();
        }
        return $this->rowMap[$row];
    }

    protected function getColumn(int $row, int $column)
    {
        if (!isset($this->columnMap[$row][$column])) {
            $this->columnMap[$row][$column] = new FormColumn();
        }
        return $this->columnMap[$row][$column];
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


}
