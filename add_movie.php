<?php


include('config/db.php');
include('classes/DB.php');
include('classes/Movies.php');
include('classes/Template.php');
include('classes/Country.php');
include('classes/Genre.php');

$movies = new Movies($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$genre = new Genre($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

$movies->open();
$country->open();
$country->getCountry();
$genre->open();
$genre->getGenre();

$data_country = null;

while ($row = $country->getResult()) {
  $data_country .= '<option value="' . $row['country_id'] . '">' . $row['country_name'] . '</option>';
}

$data_genre = null;

while ($row = $genre->getResult()) {
  $data_genre .= '<div class="form-check">
                  <input class="form-check-input" type="checkbox" name="movies_genre[]" id="genre' . $row['genre_id'] . '" value="' . $row['genre_name'] . '">
                    <label class="form-check-label" for="genre' . $row['genre_id'] . '">
                      ' . $row['genre_name'] . '
                    </label>
                  </div>';
}

// jika tombol submit ditekan
if (isset($_POST['submit'])) {

  // jika data movies berhasil ditambah
  if ($movies->addMovies($_POST) > 0) {
    echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'add_movie.php';
            </script>";
  } else {
    echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'add_movie.php';
            </script>";
  }
}

$form = '<form action="add_movie.php" method="post" enctype="multipart/form-data">
      <div class="col-md-6">
        <h3 class="mb-4">Add Movie</h3>
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="movies_title" id="title">
        </div>
        <div class="form-group">
          <label for="director">Director</label>
          <input type="text" class="form-control" name="movies_director" id="director">
        </div>
        <div class="form-group">
          <label for="cast">Cast</label>
          <input type="text" class="form-control" name="movies_cast" id="cast">
        </div>
        <div class="form-group">
          <label for="duration">Duration (minutes)</label>
          <input type="number" class="form-control" name="movies_duration" id="duration" >
        </div>
        <div class="form-group">
          <label for="released year">Released year</label>
          <input type="number" class="form-control" name="movies_released_year" id="released year" >
        </div>
        <div class="form-group">
          <label for="genre">Genre</label>
          DATA_GENRE
        </div>
        <div class="form-group">
          <label for="country">Country</label>
          <select class="form-control" name="country_id" id="country">

            DATA_COUNTRY

          </select>
        </div>
        <div class="form-group">
          <label for="synopsis">Synopsis</label>
          <textarea class="form-control" name="movies_synopsis" id="synopsis" rows="3"></textarea>
        </div>
        <div class="form-group">
          <label for="image">Image</label>
          <input type="file" class="form-control-file" name="movies_image" id="image">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>';



$movies->close();
$country->close();
$genre->close();

$home = new Template('templates/skin_form.php');
$home->replace('FORM_DATA', $form);
$home->replace('DATA_GENRE', $data_genre);
$home->replace('DATA_COUNTRY', $data_country);
$home->write();
