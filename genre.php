<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Template.php');

// instansiasi object genre
$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// koneksi object genre ke database
$genre->open();
// ambil data genre
$genre->getGenre();

// buat instance template
$view = new Template('templates/skin_table.php');

$mainTitle = 'Genre'; // judul halaman
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Genre</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'genre';

while ($div = $genre->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td style= width: 80%>' . $div['genre_name'] . '</td>
    <td style="font-size: 22px;">
        <a href="edit_genre.php?id=' . $div['genre_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="genre.php?hapus=' . $div['genre_id'] . '" onclick="return confirm(\'Are you sure you want to delete this genre?\')" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i> </a>
        </td>
    </tr>';
    $no++;
}


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($genre->deleteGenre($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'genre.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'genre.php';
            </script>";
        }
    }
}

$genre->close();


$file_tambah = "add_genre.php";
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TABEL', $data);
$view->replace('FILE_TAMBAH', $file_tambah);


$view->write();
