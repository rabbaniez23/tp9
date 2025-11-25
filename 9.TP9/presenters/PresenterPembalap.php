<?php
include_once("presenters/KontrakPresenter.php");
include_once("models/Pembalap.php");

class PresenterPembalap implements KontrakPresenter {
    private $model;
    private $view; // Kita pakai nama $view agar konsisten

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function prosesData() {
        // Ambil data dari DB
        $dataDB = $this->model->getSemuaData();
        
        // Ubah ke Objek Pembalap
        $listPembalap = [];
        foreach($dataDB as $row) {
            $pembalap = new Pembalap(
                $row['id'],
                $row['nama'],
                $row['tim'],
                $row['negara'],
                $row['poinMusim'],
                $row['jumlahMenang']
            );
            $listPembalap[] = $pembalap;
        }

        // Panggil method di View (ini yang tadi error)
        echo $this->view->tampilPembalap($listPembalap);
    }

    public function formTambah() {
        echo $this->view->tampilFormPembalap();
    }

    public function formEdit($id) {
        $result = $this->model->getDataById($id);
        if (!empty($result)) {
            $row = $result[0];
            $data = [
                'id' => $row['id'],
                'nama' => $row['nama'],
                'tim' => $row['tim'],
                'negara' => $row['negara'],
                'poinMusim' => $row['poinMusim'],
                'jumlahMenang' => $row['jumlahMenang']
            ];
            echo $this->view->tampilFormPembalap($data);
        }
    }

    public function simpan($data) {
        if (empty($data['id'])) {
            $this->model->tambahData($data);
        } else {
            $this->model->editData($data);
        }
    }

    public function hapus($id) {
        $this->model->hapusData($id);
    }
}
?>