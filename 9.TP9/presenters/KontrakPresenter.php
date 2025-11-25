<?php
// presenters/KontrakPresenter.php
interface KontrakPresenter {
    public function prosesData();
    public function formTambah();
    public function formEdit($id);
    public function simpan($data);
    public function hapus($id);
}
?>