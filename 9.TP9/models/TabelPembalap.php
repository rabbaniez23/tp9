<?php
include_once("models/DB.php");
include_once("models/KontrakModel.php");

class TabelPembalap extends DB implements KontrakModel {

    public function __construct($host, $db_name, $username, $password) {
        parent::__construct($host, $db_name, $username, $password);
    }

    // FUNGSI INI YANG MENGAMBIL DATA DARI DB
    public function getSemuaData() {
        $query = "SELECT * FROM pembalap";
        $this->executeQuery($query); // Panggil alat dari DB.php
        return $this->getAllResult(); // Ambil hasilnya
    }

    public function getDataById($id) {
        $query = "SELECT * FROM pembalap WHERE id = :id";
        $this->executeQuery($query, [':id' => $id]);
        return $this->getAllResult();
    }

    public function tambahData($data) {
        $query = "INSERT INTO pembalap (nama, tim, negara, poinMusim, jumlahMenang) 
                  VALUES (:nama, :tim, :negara, :poin, :menang)";
        $params = [
            ':nama' => $data['nama'],
            ':tim' => $data['tim'],
            ':negara' => $data['negara'],
            ':poin' => $data['poinMusim'],
            ':menang' => $data['jumlahMenang']
        ];
        return $this->executeQuery($query, $params);
    }

    public function editData($data) {
        $query = "UPDATE pembalap SET nama=:nama, tim=:tim, negara=:negara, 
                  poinMusim=:poin, jumlahMenang=:menang WHERE id=:id";
        $params = [
            ':id' => $data['id'],
            ':nama' => $data['nama'],
            ':tim' => $data['tim'],
            ':negara' => $data['negara'],
            ':poin' => $data['poinMusim'],
            ':menang' => $data['jumlahMenang']
        ];
        return $this->executeQuery($query, $params);
    }

    public function hapusData($id) {
        $query = "DELETE FROM pembalap WHERE id = :id";
        return $this->executeQuery($query, [':id' => $id]);
    }
}
?>