<?php

include_once ("models/DB.php");
include_once ("KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel {

    // Konstruktor untuk inisialisasi database
    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // Method untuk mendapatkan semua pembalap
    public function getAllPembalap(): array {
        // isi mas
    }

    // Method untuk mendapatkan pembalap berdasarkan ID
    public function getPembalapById($id): ?array {
        // ini juga isi mas
    }

    // implementasikan metode CRUD di bawah ini sesuai kebutuhan

    public function addPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // ini isi ga ya mas 
    }
    
    public function updatePembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // hayo isi ga
    }
    
    public function deletePembalap($id): void {
        // isi ga ya 
    }

}

?>