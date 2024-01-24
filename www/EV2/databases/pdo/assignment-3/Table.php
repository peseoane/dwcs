<?php
declare(strict_types=1);

class Table
{
    private string $title;
    private array $headers;
    private array $rows;
    private string $errorMessage;

    public function __construct(
        string $title = "",
        array $headers = [],
        array $rows = []
    ) {
        $this->title = $title;
        $this->headers = $headers;
        $this->rows = $rows;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    public function getRows(): array
    {
        return $this->rows;
    }

    public function setRows(array $rows): void
    {
        $this->rows = $rows;
    }

    public function getRow(int $index): array
    {
        return $this->rows[$index];
    }

    public function getCell(int $row, int $column): string
    {
        return $this->rows[$row][$column];
    }

    public function appendRow(array $row): void
    {
        $this->rows[] = $row;
    }

    public function appendCell(int $row, string $cell): void
    {
        $this->rows[$row][] = $cell;
    }

    public function renderHtml(): string
    {
        if (!empty($this->errorMessage)) {
            return "<div class='error-message'>" .
                $this->errorMessage .
                "</div>";
        }
        $html = "<h2>" . mb_strtoupper($this->title) . "</h2>";
        $html .= "<table>";
        $html .= "<tr>";
        foreach ($this->headers as $header) {
            $html .= "<th>$header</th>";
        }
        $html .= "</tr>";
        foreach ($this->rows as $row) {
            $html .= "<tr>";
            foreach ($row as $cell) {
                $html .= "<td>$cell</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";
        return $html;
    }

    public function setErrorMessage(string $message): void
    {
        $this->errorMessage = $message;
    }
}
