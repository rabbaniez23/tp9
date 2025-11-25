<?php
interface KontrakModel {
    public function getSemuaData();
    public function getDataById($id);
    public function tambahData($data);
    public function editData($data);
    public function hapusData($id);
}
?>