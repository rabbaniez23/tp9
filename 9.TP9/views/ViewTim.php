<?php
include_once 'models/Template.php'; // Sesuaikan dengan struktur template kamu

class ViewTim implements KontrakView {
    var $template;

    function __construct() {
        // Asumsi class Template ada untuk handle skin.html
        $this->template = new Template("templates/skin.html");
    }

    function render($data = null) {
        // Bagian ini merender tabel list tim
        $dataHtml = "";
        if ($data) {
            foreach($data as $row) {
                $dataHtml .= "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nama_tim'] . "</td>
                    <td>" . $row['negara_asal'] . "</td>
                    <td>" . $row['tahun_berdiri'] . "</td>
                    <td>
                        <a href='index.php?aksi=edit&id=" . $row['id'] . "'>Edit</a> |
                        <a href='index.php?aksi=hapus&id=" . $row['id'] . "'>Hapus</a>
                    </td>
                </tr>";
            }
        } else {
            $dataHtml = "<tr><td colspan='5'>Data Kosong</td></tr>";
        }

        // Replace placeholder di skin.html dengan data
        $this->template->setValue('DATA_TABEL', $dataHtml); 
        $this->template->setValue('DATA_TITLE', 'Data Tim F1');
        // Tambahkan tombol tambah
        $this->template->setValue('DATA_BUTTON', '<a href="index.php?aksi=tambah" class="btn btn-primary">Tambah Tim</a>');
        
        print $this->template->getContent();
    }
    
    // Fungsi untuk menampilkan Form Tambah/Edit
    function renderForm($data = null) {
        $title = "Tambah Tim";
        $action = "add";
        $valNama = ""; $valNegara = ""; $valTahun = ""; $id = "";

        if ($data) {
            $title = "Edit Tim";
            $action = "update";
            $id = $data['id']; // Hidden input
            $valNama = $data['nama_tim'];
            $valNegara = $data['negara_asal'];
            $valTahun = $data['tahun_berdiri'];
        }

        // Disini kamu harus punya template form atau hardcode HTML formnya
        $formHtml = "
        <form method='POST' action='index.php?aksi=$action'>
            <input type='hidden' name='id' value='$id'>
            <label>Nama Tim</label> <input type='text' name='nama_tim' value='$valNama'><br>
            <label>Negara</label> <input type='text' name='negara_asal' value='$valNegara'><br>
            <label>Tahun</label> <input type='number' name='tahun_berdiri' value='$valTahun'><br>
            <button type='submit'>Simpan</button>
        </form>
        ";
        
        // Timpa konten skin utama dengan form ini
        $this->template->setValue('DATA_TABEL', $formHtml);
        $this->template->setValue('DATA_TITLE', $title);
        $this->template->setValue('DATA_BUTTON', '<a href="index.php">Kembali</a>');
        print $this->template->getContent();
    }
}