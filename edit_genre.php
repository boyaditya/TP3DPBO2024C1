<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Template.php');

$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$genre->open();

// Fetch the current genre data
$genre_id = $_GET['id']; // Get the genre id from the URL
$genre->getGenreById($genre_id);
$current_genre = $genre->getResult();


if (isset($_POST['submit'])) {
    if ($genre->updateGenre($genre_id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'genre.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'genre.php';
            </script>";
    }
}


$form = '<form action="" method="post">
      <div class="col-md-6">
        <h3 class="mb-4">Edit Genre</h3>
        <input type="hidden" name="genre_id" value="' . $current_genre['genre_id'] . '">
        <div class="form-group">
          <label for="name">Name Genre</label>
          <input type="text" class="form-control" name="genre_name" value="' . $current_genre['genre_name'] . '" id="name">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>';



$genre->close();

$home = new Template('templates/skin_form.php');
$home->replace('FORM_DATA', $form);
$home->write();
