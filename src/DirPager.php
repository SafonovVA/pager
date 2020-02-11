<?php
namespace safonovva\pager;

class DirPager extends Pager
{
    protected string $dirname;

    public function __construct(View $view,
                                string $dirname = '.',
                                int $items_per_page = 10,
                                int $links_count = 3,
                                ?int $get_params = null,
                                string $counter_param = 'page'
    ) {
        $this->dirname = ltrim($dirname, '/');

        parent::__construct($view, $items_per_page, $links_count, $get_params, $counter_param);
    }

    public function getItemsCount(): int
    {
        $count_line = 0;

        if (($dir = opendir($this->dirname)) !== false) {
            while (($file = readdir($dir)) !== false) {
                if (is_file($this->dirname . '/' . $file)) {
                    $count_line++;
                }
            }
        }
        return $count_line;
    }

    public function getItems(): array
    {
        $current_page = $this->getCurrentPage();
        $total_pages = $this->getPagesCount();

        $arr = [];

        if ($current_page <= 0 || $current_page > $total_pages) {
            return $arr;
        }

        $first = ($current_page - 1) * $this->getItemsPerPage();

        if (($dir = opendir($this->dirname)) === false) {
            return $arr;
        }

        $i = -1;

        while (($file = readdir($dir)) !== false) {
            if (is_file($this->dirname . '/' . $file)) {
                $i++;
                if ($i < $first) {
                    continue;
                }
                if ($i > $first + $this->getItemsPerPage() - 1) {
                    break;
                }
                $arr[] = $this->dirname . '/' . $file;
            }
        }

        closedir($dir);
        return $arr;
    }
}
