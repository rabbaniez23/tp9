<?php

include_once(__DIR__ . "/KontrakPresenter.php");
include_once(__DIR__ . "/../models/TabelPembalap.php");
include_once(__DIR__ . "/../models/Pembalap.php");
include_once(__DIR__ . "/../views/ViewPembalap.php");

class PresenterPembalap implements KontrakPresenter
{
    // Model PembalapQuery untuk operasi database
    private $tabelPembalap; // Instance dari TabelPembalap (Model)
    private $viewPembalap; // Instance dari ViewPembalap (View)

    // Data list pembalap
    private $listPembalap = []; // Menyimpan array objek Pembalap

    public function __construct($tabelPembalap, $viewPembalap)
    {
        // isi mas
    }

    // Method untuk initialisasi list pembalap dari database
    public function initListPembalap()
    {
        // isi mas
    }

    // Method untuk menampilkan daftar pembalap menggunakan View
    public function tampilkanPembalap(): string
    {
        // isi mas
    }

    // Method untuk menampilkan form
    public function tampilkanFormPembalap($id = null): string
    {
        // isi juga mas
    }

    // implementasikan metode

    public function tambahPembalap($nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // isi ga ya
    }
    
    public function ubahPembalap($id, $nama, $tim, $negara, $poinMusim, $jumlahMenang): void {
        // isi ga ya
    }
    
    public function hapusPembalap($id): void {
        // isi ga ya
    }
}

?>