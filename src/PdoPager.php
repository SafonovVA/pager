<?php


namespace safonovva\pager;


class PdoPager extends Pager
{
    protected \PDO $pdo;
    protected string $table_name;
    protected string $where;
    protected array $params;
    protected string $order;

    public function __construct(View $view,
                                \PDO $pdo,
                                string $table_name,
                                string $where = '',
                                array $params = [],
                                string $order = '',
                                int $items_per_page = 10,
                                int $links_count = 3,
                                ?int $get_params = null,
                                string $counter_param = 'page'
    ) {
        $this->pdo = $pdo;
        $this->table_name = $table_name;
        $this->where = $where;
        $this->params = $params;
        $this->order = $order;
        parent::__construct($view,
            $items_per_page,
            $links_count,
            $get_params,
            $counter_param);
    }

    public function getItemsCount(): int
    {
        $query = 'SELECT COUNT(*) AS total FROM ' . $this->table_name . ' ' . $this->where;
        $tot = $this->pdo->prepare($query);
        $tot->execute($this->params);
        return $tot->fetch()['total'];
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

        $query = 'SELECT * FROM '. $this->table_name
            . ' ' . $this->where
            . ' ' . $this->order
            . ' LIMIT ' . $first
            . ', ' . $this->getItemsPerPage();

        $tbl = $this->pdo->prepare($query);
        $tbl->execute($this->params);

        return $tbl->fetchAll();
    }
}