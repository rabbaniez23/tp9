<?php
include_once("KontrakView.php");
include_once("models/Pembalap.php");

class ViewPembalap implements KontrakView {

    public function tampilPembalap($listPembalap) {
        $dataHtml = "";
        $no = 1;
        
        // 1. Buat Baris Tabel HTML
        if (!empty($listPembalap)) {
            foreach ($listPembalap as $p) {
                $dataHtml .= "<tr>
                        <td class='col-id'>" . $no++ . "</td>
                        <td>" . $p->getNama() . "</td>
                        <td>" . $p->getTim() . "</td>
                        <td>" . $p->getNegara() . "</td>
                        <td>" . $p->getPoinMusim() . "</td>
                        <td>" . $p->getJumlahMenang() . "</td>
                        <td class='col-actions'>
                            <a href='index.php?page=pembalap&aksi=edit&id=" . $p->getId() . "' class='btn btn-edit'>Edit</a>
                            <a href='index.php?page=pembalap&aksi=hapus&id=" . $p->getId() . "' class='btn btn-delete' onclick='return confirm(\"Yakin hapus?\")'>Hapus</a>
                        </td>
                    </tr>";
            }
        } else {
            $dataHtml = "<tr><td colspan='7' style='text-align:center'>Data Kosong (Cek Database)</td></tr>";
        }

        // 2. Baca Template skin.html
        $tpl = $this->bacaTemplate('skin.html');
        
       
        $tpl = str_replace('', $dataHtml, $tpl);
        
        // 4. Update Total Data
        $tpl = str_replace('Total:', 'Total: ' . count($listPembalap), $tpl);
        
        // 5. Tambahkan Menu Navigasi (Biar bisa pindah ke Tim)
        $menu = '<div style="margin-bottom:15px; font-weight:bold;">
                    <a href="index.php?page=pembalap">Data Pembalap</a> | 
                    <a href="index.php?page=tim">Data Tim</a>
                 </div>';
        $tpl = str_replace('<h1>Daftar Pembalap</h1>', $menu . '<h1>Daftar Pembalap</h1>', $tpl);
        
        // 6. Perbaiki Link Tambah Data
        $tpl = str_replace('index.php?screen=add', 'index.php?page=pembalap&aksi=tambah', $tpl);

        return $tpl;
    }

    public function tampilFormPembalap($data = null) {
        $action = "simpan";
        $id = "";
        $nama = ""; $tim = ""; $negara = ""; $poin = ""; $menang = "";

        if ($data) {
            $id = $data['id'];
            $nama = $data['nama'];
            $tim = $data['tim'];
            $negara = $data['negara'];
            $poin = $data['poinMusim'];
            $menang = $data['jumlahMenang'];
        }

        $tpl = $this->bacaTemplate('form.html');
        $tpl = str_replace('action="index.php"', 'action="index.php?page=pembalap&aksi=' . $action . '"', $tpl);
        
        $tpl = str_replace('value="" id="pembalap-id"', 'value="'.$id.'" id="pembalap-id"', $tpl);
        $tpl = str_replace('name="nama" type="text" placeholder="Nama pembalap"', 'name="nama" type="text" value="'.$nama.'"', $tpl);
        $tpl = str_replace('name="tim" type="text" placeholder="Nama tim"', 'name="tim" type="text" value="'.$tim.'"', $tpl);
        $tpl = str_replace('name="negara" type="text" placeholder="Negara (mis. Indonesia)"', 'name="negara" type="text" value="'.$negara.'"', $tpl);
        $tpl = str_replace('name="poinMusim" type="number" min="0" step="1" placeholder="0"', 'name="poinMusim" type="number" value="'.$poin.'"', $tpl);
        $tpl = str_replace('name="jumlahMenang" type="number" min="0" step="1" placeholder="0"', 'name="jumlahMenang" type="number" value="'.$menang.'"', $tpl);

        return $tpl;
    }

    private function bacaTemplate($filename) {
        $path = __DIR__ . '/../template/' . $filename;
        if (file_exists($path)) {
            return file_get_contents($path);
        }
        return "Error: Template $filename tidak ditemukan.";
    }
}
?>