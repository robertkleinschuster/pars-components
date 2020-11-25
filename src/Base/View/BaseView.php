<?php

namespace Pars\Component\Base\View;

use Pars\Mvc\View\AbstractView;

class BaseView extends AbstractView
{
    public ?string $language = 'de';
    public ?string $title = 'PARS Admin';
    public ?string $author = 'Robert Kleinschuster';
    public ?string $favicon = 'favicon.ico';
    public ?string $description = 'PARS Admin';
    public ?string $charset = 'utf-8';
}
