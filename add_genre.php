<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Genre.php');
include('classes/Template.php');

$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$genre->open();


// jika tombol submit ditekan
if (isset($_POST['submit'])) {
    // jika data genre berhasil ditambah
    if ($genre->addGenre($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'genre.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'genre.php';
            </script>";
    }
}

$form = '<form action="" method="post">
      <div class="col-md-6">
        <h3 class="mb-4">Add Genre</h3>
        <div class="form-group">
          <label for="name">Name Genre</label>
          <input type="text" class="form-control" name="genre_name" id="name">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>';



$genre->close();

$home = new Template('templates/skin_form.php');
$home->replace('FORM_DATA', $form);
$home->write();
