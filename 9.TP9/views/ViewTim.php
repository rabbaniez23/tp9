<?php
include_once("KontrakView.php");

class ViewTim {

    // Menampilkan Tabel Tim dengan desain skin.html
    public function render($data) {
        $dataHtml = "";
        if(!empty($data)){
            foreach($data as $row){
                $dataHtml .= "<tr>
                        <td class='col-id'>{$row['id']}</td>
                        <td>{$row['nama_tim']}</td>
                        <td>{$row['negara_asal']}</td>
                        <td>{$row['tahun_berdiri']}</td>
                        <td class='col-actions'>
                            <a href='index.php?page=tim&aksi=edit&id={$row['id']}' class='btn btn-edit'>Edit</a>
                            <a href='index.php?page=tim&aksi=hapus&id={$row['id']}' class='btn btn-delete' onclick='return confirm(\"Yakin?\")'>Hapus</a>
                        </td>
                      </tr>";
            }
        } else {
            $dataHtml = "<tr><td colspan='5'>Data Kosong</td></tr>";
        }

        // OUTPUT HTML
        echo '<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Daftar Tim</title>
  <style>
    :root{ --bg: #f7f8fb; --card: #ffffff; --muted: #6b7280; --accent: #2563eb; --danger: #ef4444; --border: #e6e9ef; --radius: 8px; --pad: 14px; font-family: system-ui, -apple-system, sans-serif; }
    html,body{height:100%;margin:0;background:var(--bg);}
    .container{max-width:980px;margin:36px auto;padding:18px;}
    .card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:12px;box-shadow: 0 1px 2px rgba(16,24,40,0.03);}
    h1{margin:0 0 12px 0;font-size:18px}
    table{width:100%;border-collapse:collapse;font-size:14px}
    thead th{ text-align:left;padding:12px 10px;background:transparent;color:var(--muted);font-weight:600;border-bottom:1px solid var(--border)}
    tbody td{padding:12px 10px;border-bottom:1px solid var(--bg);vertical-align:middle}
    .col-id{width:48px;color:var(--muted);}
    .col-actions{width:170px;text-align:right}
    .btn{display:inline-block;padding:8px 10px;border-radius:6px;font-size:13px;cursor:pointer;text-decoration:none;}
    .btn-edit{color:var(--accent);}
    .btn-delete{color:var(--danger);margin-left:8px}
    .btn-add{background:var(--accent);color:#fff;border:none;padding:10px 14px;border-radius:8px;display:inline-flex;align-items:center;gap:8px;text-decoration:none;}
    tbody tr:hover td{background:linear-gradient(90deg, rgba(37,99,235,0.02), transparent)}
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <div style="margin-bottom:15px; font-weight:bold;">
         <a href="index.php?page=pembalap">Data Pembalap</a> | 
         <a href="index.php?page=tim">Data Tim</a>
      </div>
      <h1>Daftar Tim F1</h1>

      <div style="overflow:auto;">
        <table>
          <thead>
            <tr>
              <th class="col-id">ID</th>
              <th>Nama Tim</th>
              <th>Negara Asal</th>
              <th>Tahun Berdiri</th>
              <th class="col-actions">Aksi</th>
            </tr>
          </thead>
          <tbody>
            '. $dataHtml .'
          </tbody>
        </table>
      </div>

      <div style="margin-top:14px;display:flex;justify-content:space-between;align-items:center">
        <div style="color:var(--muted);font-size:13px">Total Data: '.count($data).'</div>
        <div>
          <a href="index.php?page=tim&aksi=tambah" class="btn btn-add">+ Tambah Tim</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>';
    }

    // Menampilkan Form Tim
    public function renderForm($data = null) {
        $action = "simpan";
        $id = "";
        $nama = ""; $negara = ""; $tahun = "";
        
        if ($data) {
            $id = $data['id'];
            $nama = $data['nama_tim'];
            $negara = $data['negara_asal'];
            $tahun = $data['tahun_berdiri'];
        }

        echo '<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Form Tim</title>
  <style>
    :root{ --bg: #f7f8fb; --card: #ffffff; --muted: #6b7280; --accent: #2563eb; --danger: #ef4444; --border: #e6e9ef; --radius: 8px; font-family: system-ui, sans-serif; }
    html,body{height:100%;margin:0;background:var(--bg);}
    .container{max-width:700px;margin:36px auto;padding:18px;}
    .card{background:var(--card);border:1px solid var(--border);border-radius:var(--radius);padding:18px}
    form{display:grid;gap:12px}
    label{display:block;font-size:13px;color:var(--muted);margin-bottom:6px}
    input[type="text"], input[type="number"]{width:100%;padding:10px;border:1px solid var(--border);border-radius:6px;font-size:14px;box-sizing:border-box}
    .actions{display:flex;gap:10px;justify-content:flex-end;margin-top:8px}
    .btn{padding:10px 14px;border-radius:8px;border:1px solid transparent;font-size:14px;cursor:pointer;text-decoration:none;}
    .btn-primary{background:var(--accent);color:#fff}
    .btn-muted{background:transparent;border:1px solid var(--border);color:var(--muted)}
  </style>
</head>
<body>
  <div class="container">
    <div class="card">
      <h1>Form Data Tim</h1>
      <form method="post" action="index.php?page=tim&aksi=simpan">
        <input type="hidden" name="id" value="'.$id.'">

        <div>
          <label>Nama Tim</label>
          <input name="nama_tim" type="text" value="'.$nama.'" required>
        </div>

        <div>
          <label>Negara Asal</label>
          <input name="negara_asal" type="text" value="'.$negara.'" required>
        </div>

        <div>
          <label>Tahun Berdiri</label>
          <input name="tahun_berdiri" type="number" value="'.$tahun.'" required>
        </div>

        <div class="actions">
          <a href="index.php?page=tim" class="btn btn-muted">Batal</a>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>';
    }
}
?>