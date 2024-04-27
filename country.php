<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Country.php');
include('classes/Template.php');

// instansiasi object country
$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
// koneksi object country ke database
$country->open();
// ambil data country
$country->getCountry();

// buat instance template
$view = new Template('templates/skin_table.php');

$mainTitle = 'Country'; // judul halaman
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Country</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'country';

while ($div = $country->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td style= width: 80%>' . $div['country_name'] . '</td>
    <td style="font-size: 22px;">
        <a href="edit_country.php?id=' . $div['country_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="country.php?hapus=' . $div['country_id'] . '" onclick="return confirm(\'Are you sure you want to delete this country?\')" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i> </a>
        </td>
    </tr>';
    $no++;
}


if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($country->deleteCountry($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'country.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'country.php';
            </script>";
        }
    }
}

$country->close();


$file_tambah = "add_country.php";
$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TABEL', $data);
$view->replace('FILE_TAMBAH', $file_tambah);


$view->write();
