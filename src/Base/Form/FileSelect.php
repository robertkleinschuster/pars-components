<?php


namespace Pars\Component\Base\Form;


class FileSelect extends Select
{
    private array $files = [];

    protected function initialize()
    {
        $this->setType(self::TYPE_TEXT);
        $this->addOption('fileselect-modal');
        if ($this->hasFiles()) {
            $this->setData('fileselect-list', json_encode($this->getFiles()));
            $this->options = $this->selectOptions($this->getFiles());
        }
        #$this->setData('bs-toggle', 'modal');
        #$this->setData('bs-target', '#fileselect-modal');
        parent::initialize();
    }

    protected function selectOptions($files)
    {
        $options = [];
        foreach ($files as $key => $value) {
            if (is_array($value)) {
                foreach ($this->selectOptions($value) as $k => $v) {
                    $options[$k] = $v;
                }
            } else {
                $options[$key] = $value;
            }
        }
        return $options;
    }

    /**
     * @param string $name
     * @param string|null $id
     * @param string|null $folder
     */
    public function addFile(string $name, ?string $id, string $folder = null)
    {
        if ($folder) {
            $this->files[$folder][$id] = $name;
        } else {
            $this->files[$id] = $name;
        }
    }

    /**
     * @return array
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * @param array $files
     *
     * @return $this
     */
    public function setFiles(array $files): self
    {
        $this->files = $files;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasFiles(): bool
    {
        return isset($this->files);
    }


}
