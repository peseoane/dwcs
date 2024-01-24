<?php
declare(strict_types=1);

interface PaginationBuilder
{
    public function setPageSize(int $pageSize): void;
    public function setFilter(string $filter): void;
    public function sortByColumn(string $column): void;
    public function setCurrentPage(int $currentPage): void;
    public function getTotalPages(): int;
    public function defineSort(string $value): void;
}
