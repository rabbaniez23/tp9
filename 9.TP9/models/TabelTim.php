<?php
include_once("models/DB.php");
include_once("models/KontrakModel.php");

class TabelTim extends DB implements KontrakModel {

    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    public function getSemuaData() {
        $query = "SELECT * FROM tim";
        $this->executeQuery($query);
        return $this->getAllResult();
    }

    public function getDataById($id) {
        $query = "SELECT * FROM tim WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
        return $this->getAllResult();
    }

    public function tambahData($data) {
        $query = "INSERT INTO tim (nama_tim, negara_asal, tahun_berdiri) 
                  VALUES (:nama, :negara, :tahun)";
        $params = [
            ':nama' => $data['nama_tim'],
            ':negara' => $data['negara_asal'],
            ':tahun' => $data['tahun_berdiri']
        ];
        return $this->executeQuery($query, $params);
    }

    public function editData($data) {
        $query = "UPDATE tim SET nama_tim=:nama, negara_asal=:negara, tahun_berdiri=:tahun 
                  WHERE id=:id";
        $params = [
            ':id' => $data['id'],
            ':nama' => $data['nama_tim'],
            ':negara' => $data['negara_asal'],
            ':tahun' => $data['tahun_berdiri']
        ];
        return $this->executeQuery($query, $params);
    }

    public function hapusData($id) {
        $query = "DELETE FROM tim WHERE id = :id";
        return $this->executeQuery($query, [':id' => $id]);
    }
}
?>