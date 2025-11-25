<?php

// 1. Include Model (Koneksi Database & Logika Data)
include_once("models/DB.php");
include_once("models/KontrakModel.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelTim.php"); // Pastikan file ini sudah dibuat sesuai langkah sebelumnya

// 2. Include View (Tampilan/HTML)
include_once("views/KontrakView.php");
include_once("views/ViewPembalap.php");
include_once("views/ViewTim.php"); // Pastikan file ini sudah dibuat

// 3. Include Presenter (Penghubung Model & View)
include_once("presenters/KontrakPresenter.php");
include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterTim.php"); // Pastikan file ini sudah dibuat

// ==========================================================
// KONFIGURASI KONEKSI DATABASE
// ==========================================================
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'mvp_db';

// ==========================================================
// ROUTING (PENGATUR HALAMAN)
// ==========================================================

// Cek mau buka halaman apa? Default ke 'pembalap'
$page = isset($_GET['page']) ? $_GET['page'] : 'pembalap';
// Cek mau melakukan aksi apa? Default ke 'view' (tampil tabel)
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';


// ----------------------------------------------------------
// HALAMAN 1: PEMBALAP
// ----------------------------------------------------------
if ($page == 'pembalap') {
    
    // Inisialisasi Objek MVP Pembalap
    $model = new TabelPembalap($db_host, $db_user, $db_pass, $db_name);
    $view = new ViewPembalap();
    $presenter = new PresenterPembalap($model, $view);

    if ($aksi == 'view') {
        // Tampilkan Tabel Utama
        $presenter->prosesData(); 
    } 
    elseif ($aksi == 'tambah') {
        // Tampilkan Form Tambah
        $presenter->formTambah();
    } 
    elseif ($aksi == 'edit') {
        // Tampilkan Form Edit (ambil ID dari URL)
        $id = $_GET['id'];
        $presenter->formEdit($id);
    } 
    elseif ($aksi == 'simpan') {
        // Proses Simpan Data (dari Form)
        // Pastikan form HTML method="POST" action="index.php?page=pembalap&aksi=simpan"
        $presenter->simpan($_POST); 
        header("Location: index.php?page=pembalap"); // Redirect balik ke tabel
    } 
    elseif ($aksi == 'hapus') {
        // Proses Hapus Data
        $id = $_GET['id'];
        $presenter->hapus($id);
        header("Location: index.php?page=pembalap"); // Redirect balik ke tabel
    }
}

// ----------------------------------------------------------
// HALAMAN 2: TIM (Tugas Poin 2 - Tabel Baru)
// ----------------------------------------------------------
elseif ($page == 'tim') {
    
    // Inisialisasi Objek MVP Tim
    $model = new TabelTim($db_host, $db_user, $db_pass, $db_name);
    $view = new ViewTim();
    $presenter = new PresenterTim($model, $view);

    if ($aksi == 'view') {
        $presenter->prosesData();
    } 
    elseif ($aksi == 'tambah') {
        $presenter->formTambah();
    } 
    elseif ($aksi == 'edit') {
        $id = $_GET['id'];
        $presenter->formEdit($id);
    } 
    elseif ($aksi == 'simpan') {
        $presenter->simpan($_POST); 
        header("Location: index.php?page=tim");
    } 
    elseif ($aksi == 'hapus') {
        $id = $_GET['id'];
        $presenter->hapus($id);
        header("Location: index.php?page=tim");
    }
}

?>