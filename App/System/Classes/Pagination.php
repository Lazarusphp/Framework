<?php
namespace App\System\Classes;
use LazarusPhp\DatabaseManager\Database;

class Pagination extends Database
{
    
  
    private $sql;
    private $recordsPerPage;
    private $totalRecords;
    private $totalPages;
    private $currentPage;
    private $db;

    public function __construct($sql,$results=10)
    {

     parent::__construct();
        // Return Nothing
    $this->sql = $sql;
    $this->recordsPerPage = $results;
    $this->calculateTotalRecords();
    $this->calculateTotalPages();
    }

    public function __destruct()
    {
        // return Nothing 
    }

 

    public function calculateTotalRecords()
    {
        // Using the same Sql Replace the text with COUNT()
        $pattern = "/SELECT\s+\*\s+FROM/i";
        $replace = "select COUNT(*) FROM";

        $sql = preg_replace($pattern,$replace,$this->sql);
        $this->totalRecords = $this->sql($sql)->FetchColumn();
    }

    private function calculateTotalPages() {
        $this->totalPages = ceil($this->totalRecords / $this->recordsPerPage);
    }

    private function getCurrentPage() {
        $this->currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($this->currentPage < 1) {
            $this->currentPage = 1;
        } elseif ($this->currentPage > $this->totalPages) {
            $this->currentPage = $this->totalPages;
        }
        return $this->currentPage;
    }

    public function getOffset() {
        return ($this->getCurrentPage() - 1) * $this->recordsPerPage;
    }

    public function getRecords() { 
        $offset = $this->getOffset();
        return $this->sql($this->sql." LIMIT :limit OFFSET :offset ",[":limit"=>$this->recordsPerPage,":offset"=>$offset])->All();
    }

    public function createLinks() {
        $links = '';
        for ($page = 1; $page <= $this->totalPages; $page++) {
            $links .= '<a href="?page=' . $page . '">' . $page . '</a> ';
        }
        return $links;
    }

}