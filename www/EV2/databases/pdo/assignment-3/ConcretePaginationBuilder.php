<?php
declare(strict_types=1);

require_once "PaginationBuilder.php";
require_once "DbCon.php";
require_once "Table.php";
require_once "Controls.php";

class ConcretePaginationBuilder implements PaginationBuilder
{
    private Table $table;
    private int $pageSize;
    private string $filter;
    private string $sortVal;
    private string $sortByColumn;
    private DbCon $dbCon;
    private Controls $controls;
    private string $dbTableName;
    private int $currentPage;

    public function __construct(string $dbTableName)
    {
        $this->reset();
        $this->dbCon = DbCon::getInstance();
        $this->table = new Table();
        $this->controls = new Controls();
        $this->dbTableName = $dbTableName;
    }

    private function reset(): void
    {
        $this->pageSize = 4;
        $this->filter = "";
        $this->sortVal = "ASC";
        $this->sortByColumn = "";
        $this->currentPage = 1;
    }

    #[Override]
    public function setPageSize(int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    #[Override]
    public function setFilter(string $filter): void
    {
        $this->filter = $filter;
    }

    #[Override]
    public function defineSort(string $value): void
    {
        $this->sortVal = $value;
    }

    public function getTable(): Table
    {
        return $this->table;
    }

    #[Override]
    public function sortByColumn(string $column): void
    {
        $this->sortByColumn = $column;
    }

    #[Override]
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    public function build(): void
    {
        $query = "SELECT * FROM " . $this->dbTableName;

        if (!empty($this->filter)) {
            $query .= " WHERE titulo LIKE '%" . $this->filter . "%'";
        }
        if (!empty($this->sortByColumn)) {
            $query .= " ORDER BY " . $this->sortByColumn;

            if ($this->sortVal) {
                $query .= " ASC";
            } else {
                $query .= " DESC";
            }
        }

        $offset = ($this->currentPage - 1) * $this->pageSize;
        $query .= " LIMIT " . $offset . ", " . $this->pageSize;

        $result = $this->dbCon->runQueryAssoc($query);

        var_dump($query);

        if (empty($result)) {
            $this->table->setErrorMessage(
                "No se encontraron resultados. Por favor, realiza una nueva búsqueda."
            );
            $this->reset();
            $this->build();
        }
        $this->table->setTitle($this->dbTableName);
        $this->table->setHeaders($this->dbCon->getHeaders($result));
        $this->table->setRows($result);
    }

    public function renderHtml(): string
    {
        $tableHtml = $this->table->renderHtml();
        $controlsHtml = $this->controls->renderHtml(
            $this->currentPage,
            $this->getTotalPages()
        );

        return "<div class='pagination-container'>" .
            $tableHtml .
            $controlsHtml .
            "</div>";
    }

    #[Override]
    public function getTotalPages(): int
    {
        $query = "SELECT COUNT(*) FROM " . $this->dbTableName;
        if (!empty($this->filter)) {
            $query .= " WHERE titulo LIKE '%" . $this->filter . "%'";
        }
        $totalRows = $this->dbCon->runQuerySingle($query);
        return (int) ceil($totalRows / $this->pageSize);
    }
}
