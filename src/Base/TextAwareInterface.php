<?php


namespace Pars\Component\Base;


interface TextAwareInterface
{
    /**
     * @return string
     */
    public function getText(): string;

    /**
     * @param string $text
     *
     * @return $this
     */
    public function setText(string $text);

    /**
     * @return bool
     */
    public function hasText(): bool;

}
