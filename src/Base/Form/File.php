<?php


namespace Pars\Component\Base\Form;


use Pars\Mvc\View\HtmlElement;

class File extends Input
{

    public const ACCEPT_IMAGE = 'image/*';
    public const ACCEPT_VIDEO = 'video/*';
    public const ACCEPT_AUDIO = 'audio/*';
    public const ACCEPT_TEXT = 'text/*';

    public const CAPTURE_USER = 'user';
    public const CAPTURE_ENVIRONMENT = 'environment';

    /**
     * @var string[]
     */
    private ?array $acceptTypes = null;

    /**
     * @var bool
     */
    private bool $multiple = false;

    /**
     * @var string|null
     */
    private ?string $capture = null;

    /**
     * @var Input|null
     */
    protected ?Input $input = null;

    private ?string $customLabel = null;

    protected function initialize()
    {
        $this->getInput()->fromArray($this->toArray());

        $this->setValue('');
        $this->setName('');
        $this->setId('');
        parent::initialize();
        $this->setTag('div');
        $this->addOption('custom-file');
        $this->getInput()->setType(Input::TYPE_FILE);
        $this->getInput()->addOption('custom-file-input');
        if ($this->hasAcceptTypes()) {
            $this->getInput()->setAttribute('accept', implode(',', $this->getAcceptTypes()));
        }
        if ($this->hasCapture()) {
            $this->getInput()->setAttribute('capture', $this->getCapture());
        }
        if ($this->getMultiple()) {
            $this->getInput()->setAttribute('multiple', 'multiple');
        }
        $script = new HtmlElement('script');
        $script->setContent("
document.getElementById('{$this->getInput()->getName()}').addEventListener('change', function(e) {
    var file = document.getElementById('{$this->getInput()->getName()}').files[0];
    e.target.nextElementSibling.innerText = file.name;
    if (file.type == 'image/png' && document.getElementById('FileType_Code')) {
        document.getElementById('FileType_Code').value = 'png';
    }
    if (file.type == 'image/jpeg' && document.getElementById('FileType_Code')) {
        document.getElementById('FileType_Code').value = 'jpg';
    }
    if (document.getElementById('File_Name')) {
        document.getElementById('File_Name').value = file.name;
    }
    if (document.getElementById('File_Code')) {
        document.getElementById('File_Code').value = file.name;
    }
});");

        $this->push($this->getInput());
        $label = new Label();
        $label->addOption('custom-file-label');
        $label->setFor($this->getInput()->getName());
        $label->setContent($this->getInput()->getValue());
        $label->addOption('rounded-0');
        $this->addOption('border-0');
        $this->push($label);
        $this->push($script);
    }

    /**
     * @return string
     */
    public function getCustomLabel(): string
    {
        return $this->customLabel;
    }

    /**
     * @param string $customLabel
     *
     * @return $this
     */
    public function setCustomLabel(string $customLabel): self
    {
        $this->customLabel = $customLabel;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCustomLabel(): bool
    {
        return isset($this->customLabel);
    }

    /**
     * @return Input|null
     */
    public function getInput(): ?Input
    {
        if (null === $this->input) {
            $this->input = new Input();
        }
        return $this->input;
    }

    /**
     * @return array
     */
    public function getAcceptTypes(): array
    {
        return $this->acceptTypes;
    }

    /**
     * @param array $acceptTypes
     *
     * @return $this
     */
    public function setAcceptTypes(array $acceptTypes): self
    {
        $this->acceptTypes = $acceptTypes;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasAcceptTypes(): bool
    {
        return isset($this->acceptTypes);
    }


    /**
     * @return string
     */
    public function getCapture(): string
    {
        return $this->capture;
    }

    /**
     * @param string $capture
     *
     * @return $this
     */
    public function setCapture(string $capture): self
    {
        $this->capture = $capture;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasCapture(): bool
    {
        return isset($this->capture);
    }

    /**
     * @return bool
     */
    public function getMultiple(): bool
    {
        return $this->multiple;
    }

    /**
     * @param bool $multiple
     * @return File
     */
    public function setMultiple(bool $multiple): File
    {
        $this->multiple = $multiple;
        return $this;
    }


}
