<?php
// models/TabelTim.php
class TabelTim extends DB implements KontrakModel {
    
    // Harus pakai nama 'getSemuaData' sesuai kontrak, isinya query Tim
    function getSemuaData() {
        $query = "SELECT * FROM tim";
        return $this->execute($query);
    }

    // Harus 'getDataById' sesuai kontrak
    function getDataById($id) {
        $query = "SELECT * FROM tim WHERE id = $id";
        return $this->execute($query);
    }

    // Harus 'tambahData' sesuai kontrak
    function tambahData($data) {
        $nama = $data['nama_tim'];
        $negara = $data['negara_asal'];
        $tahun = $data['tahun_berdiri'];
        
        $query = "INSERT INTO tim (nama_tim, negara_asal, tahun_berdiri) VALUES ('$nama', '$negara', '$tahun')";
        return $this->execute($query);
    }

    // Harus 'editData' sesuai kontrak
    function editData($data) {
        $id = $data['id'];
        $nama = $data['nama_tim'];
        $negara = $data['negara_asal'];
        $tahun = $data['tahun_berdiri'];
        
        $query = "UPDATE tim SET nama_tim='$nama', negara_asal='$negara', tahun_berdiri='$tahun' WHERE id=$id";
        return $this->execute($query);
    }

    // Harus 'hapusData' sesuai kontrak
    function hapusData($id) {
        $query = "DELETE FROM tim WHERE id = $id";
        return $this->execute($query);
    }
}
?>