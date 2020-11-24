<?php


namespace Pars\Component\Base;


trait TextAwareTrait
{
    private ?string $text = null;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasText(): bool
    {
        return $this->text !== null;
    }

}
