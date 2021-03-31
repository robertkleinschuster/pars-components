<?php


namespace Pars\Component\Base\Toolbar;


use Pars\Component\Base\Field\Icon;

class MoreButton extends ToolbarButton
{
    protected bool $show = false;

    protected function initialize()
    {
        $this->setStyle(self::STYLE_SECONDARY);
        $icon = new Icon(Icon::ICON_CHEVRONS_DOWN);
        if ($this->isShow()) {
            $icon->setName(Icon::ICON_CHEVRONS_UP);
        }
        $icon->setTag('span');
        $this->push($icon);
        parent::initialize();
    }

    /**
     * @return bool
     */
    public function isShow(): bool
    {
        return $this->show;
    }

    /**
     * @param bool $show
     * @return MoreButton
     */
    public function setShow(bool $show): MoreButton
    {
        $this->show = $show;
        return $this;
    }


}
