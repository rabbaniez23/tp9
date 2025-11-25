<?php

// 1. Include Semua File
include_once("models/DB.php");
include_once("models/KontrakModel.php");
include_once("models/TabelPembalap.php");
include_once("models/TabelTim.php");

include_once("views/KontrakView.php");
include_once("views/ViewPembalap.php");
include_once("views/ViewTim.php");

include_once("presenters/KontrakPresenter.php");
include_once("presenters/PresenterPembalap.php");
include_once("presenters/PresenterTim.php");

// 2. Konfigurasi Database
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'mvp_db';

// 3. Routing
$page = isset($_GET['page']) ? $_GET['page'] : 'pembalap';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'view';

// Menangani request dari form Pembalap (karena form.html punya field hidden 'action')
if(isset($_POST['action']) && $page == 'pembalap') {
    if($_POST['action'] == 'add' || $_POST['action'] == 'update' || $_POST['action'] == 'edit') {
        $aksi = 'simpan';
    } elseif($_POST['action'] == 'delete') {
        $aksi = 'hapus';
    }
}
// Menangani request dari screen parameter (legacy code)
if(isset($_GET['screen'])) {
    if($_GET['screen'] == 'add') $aksi = 'tambah';
    if($_GET['screen'] == 'edit') $aksi = 'edit';
}


// --- ROUTING PEMBALAP ---
if ($page == 'pembalap') {
    $model = new TabelPembalap($db_host, $db_name, $db_user, $db_pass);
    $view = new ViewPembalap();
    $presenter = new PresenterPembalap($model, $view);

    if ($aksi == 'view') {
        $presenter->prosesData();
    } elseif ($aksi == 'tambah') {
        $presenter->formTambah();
    } elseif ($aksi == 'edit') {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $presenter->formEdit($id);
    } elseif ($aksi == 'simpan') {
        $presenter->simpan($_POST);
        header("Location: index.php?page=pembalap");
    } elseif ($aksi == 'hapus') {
        // Cek ID dari GET atau POST
        $id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
        if($id) $presenter->hapus($id);
        header("Location: index.php?page=pembalap");
    }
}

// --- ROUTING TIM ---
elseif ($page == 'tim') {
    $model = new TabelTim($db_host, $db_name, $db_user, $db_pass);
    $view = new ViewTim();
    $presenter = new PresenterTim($model, $view);

    if ($aksi == 'view') {
        $presenter->prosesData();
    } elseif ($aksi == 'tambah') {
        $presenter->formTambah();
    } elseif ($aksi == 'edit') {
        $id = $_GET['id'];
        $presenter->formEdit($id);
    } elseif ($aksi == 'simpan') {
        $presenter->simpan($_POST);
        header("Location: index.php?page=tim");
    } elseif ($aksi == 'hapus') {
        $id = $_GET['id'];
        $presenter->hapus($id);
        header("Location: index.php?page=tim");
    }
}
?>