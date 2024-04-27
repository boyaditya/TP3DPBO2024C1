<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Movies.php');

$movies = new Movies($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$movies->open();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if ($movies->deleteMovies($id) > 0) {
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