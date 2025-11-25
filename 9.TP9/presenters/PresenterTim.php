<?php
class PresenterTim implements KontrakPresenter {
    var $model;
    var $view;

    function __construct() {
        $this->model = new TabelTim();
        $this->view = new ViewTim();
    }

    function prosesData() {
        // Logika sederhana untuk menentukan apa yang harus ditampilkan
        // (Biasanya logic CRUD ada di index.php atau di handle di sini tergantung struktur projectmu)
        
        // Contoh default: Tampilkan list
        $data = $this->model->getTim(); 
        // Array data dari model harus diproses (fetch_array) dulu biasanya di Model atau disini
        // Asumsi data sudah berupa array asosiatif
        $this->view->render($data);
    }
    
    function formTambah() {
        $this->view->renderForm();
    }

    function formEdit($id) {
        $data = $this->model->getTimById($id);
        $row = $data->fetch_assoc(); // Ambil satu baris
        $this->view->renderForm($row);
    }

    function add($post) {
        $this->model->addTim($post['nama_tim'], $post['negara_asal'], $post['tahun_berdiri']);
        header("Location: index.php");
    }

    function update($post) {
        $this->model->updateTim($post['id'], $post['nama_tim'], $post['negara_asal'], $post['tahun_berdiri']);
        header("Location: index.php");
    }

    function delete($id) {
        $this->model->deleteTim($id);
        header("Location: index.php");
    }
}