<?php

class Paginator
{
    private $totalRecords;
    private $recordsPerPage;
    private $currentPage;
    private $url;

    public function __construct($totalRecords, $recordsPerPage, $currentPage, $url)
    {
        $this->totalRecords = $totalRecords;
        $this->recordsPerPage = $recordsPerPage;
        $this->currentPage = $currentPage;
        $this->url = $url;
    }

    public function getTotalRecords()
    {
        return $this->totalRecords;
    }

    public function getRecordsPerPage()
    {
        return $this->recordsPerPage;
    }

    private function calculateTotalPages()
    {
        return ceil($this->totalRecords / $this->recordsPerPage);
    }

    private function generatePageLink($page)
    {
        return $this->url . '?page=' . $page;
    }

    public function generatePagination()
    {
        $totalPages = $this->calculateTotalPages();

        if ($totalPages > 1) {
            echo '<ul class="pagination">';

            // Página anterior
            if ($this->currentPage > 1) {
                echo '<li class="page-item"><a class="page-link" href="' . $this->generatePageLink($this->currentPage - 1) . '">Anterior</a></li>';
            }

            // Páginas numeradas
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<li class="page-item ' . ($this->currentPage == $i ? 'active' : '') . '"><a class="page-link" href="' . $this->generatePageLink($i) . '">' . $i . '</a></li>';
            }

            // Página siguiente
            if ($this->currentPage < $totalPages) {
                echo '<li class="page-item"><a class="page-link" href="' . $this->generatePageLink($this->currentPage + 1) . '">Siguiente</a></li>';
            }

            echo '</ul>';
        }
    }
}
