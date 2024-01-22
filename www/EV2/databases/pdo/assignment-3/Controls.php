<?php
declare(strict_types=1);
class Controls
{
    public function renderHtml(int $currentPage, int $totalPages): string
    {
        $html = "<div id='paginado'>";
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                $html .= "<span>$i</span>";
            } else {
                $html .= "<a href='?page=$i'>$i</a>";
            }

            if ($i != $totalPages) {
                $html .= " | ";
            }

        }
        $html .= "</div>";
        return $html;
    }
}