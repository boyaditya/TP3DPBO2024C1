<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Series.php');

$series = new Series($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$series->open();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if ($series->deleteSeries($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}