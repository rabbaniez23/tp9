<?php
include_once("presenters/KontrakPresenter.php");

class PresenterTim implements KontrakPresenter {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function prosesData() {
        $data = $this->model->getSemuaData();
        $this->view->render($data);
    }

    public function formTambah() {
        $this->view->renderForm();
    }

    public function formEdit($id) {
        $data = $this->model->getDataById($id);
        if(!empty($data)){
            $this->view->renderForm($data[0]);
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