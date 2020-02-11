<?php


namespace safonovva\pager;


class ItemsRange extends View
{
    public function range($first, $second)
    {
        return '[' . $first . ' - ' . $second . ']';
    }

    public function render(Pager $pager)
    {
        $this->pager = $pager;
        $return_page = '';
        $current_page = $this->pager->getCurrentPage();
        $total_pages = $this->pager->getPagesCount();

        if ($current_page - $this->pager->getVisibleLinkCount() > 1) {
            $range = $this->range(1, $this->pager->getItemsPerPage());
            $return_page .= $this->link($range, 1) . ' ... ';
            $init = $current_page - $this->pager->getVisibleLinkCount();
            for ($i = $init; $i < $current_page; $i++) {
                $first = ($i - 1) * $this->pager->getItemsPerPage() + 1;
                $second = $i * $this->pager->getItemsPerPage();
                $range = $this->range($first, $second);
                $return_page .= ' ' . $this->link($range, $i) . ' ';
            }
        } else {
            for ($i = 1; $i < $current_page; $i++) {
                $first = ($i - 1) * $this->pager->getItemsPerPage() + 1;
                $second = $i * $this->pager->getItemsPerPage();
                $range = $this->range($first, $second);
                $return_page .= ' ' . $this->link($range, $i) . ' ';
            }
        }

        if ($current_page + $this->pager->getVisibleLinkCount() < $total_pages) {
            $cond = $current_page + $this->pager->getVisibleLinkCount();
            for ($i = $current_page; $i <= $cond; $i++) {
                $first = ($i - 1) * $this->pager->getItemsPerPage() + 1;
                $second = $i * $this->pager->getItemsPerPage();
                $range = $this->range($first, $second);
                if ($current_page == $i) {
                    $return_page .= ' ' . $range . ' ';
                } else {
                    $return_page .= ' ' . $this->link($range, $i) . ' ';
                }
            }
            $first = ($total_pages - 1) * $this->pager->getItemsPerPage() + 1;
            $second = $this->pager->getItemsCount();
            $range = $this->range($first, $second);
            $return_page .= ' ... ' . $this->link($range, $total_pages) . ' ';
        } else {
            for ($i = $current_page; $i <= $total_pages; $i++) {
                $first = ($i - 1) * $this->pager->getItemsPerPage() + 1;
                if ($total_pages == $i) {
                    $second = $this->pager->getItemsCount();
                    $range = $this->range($first, $second);
                    if ($current_page == $i) {
                        $return_page .= ' ' . $range . ' ';
                    } else {
                        $return_page .= ' ' . $this->link($range, $i) . ' ';
                    }
                } else {
                    $second = $i * $this->pager->getItemsPerPage();
                    $range = $this->range($first, $second);
                    if ($current_page == $i) {
                        $return_page .= ' ' . $range . ' ';
                    } else {
                        $return_page .= ' ' . $this->link($range, $i) . ' ';
                    }
                }
            }
        }
        return $return_page;
    }
}