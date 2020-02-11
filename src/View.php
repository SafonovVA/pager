<?php


namespace safonovva\pager;


abstract class View
{
    protected Pager $pager;
    public function link(string $title, int $current_page = 1)
    {
        return '<a href="' . $this->pager->getCurrentPagePath() . '?'
            . $this->pager->getCounterParam() . '=' . $current_page
            . $this->pager->getParameters() . '">' . $title . '</a>';
    }

    abstract public function render(Pager $pager);
}