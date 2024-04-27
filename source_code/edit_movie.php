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

// Fetch the current movie data
$movie_id = $_GET['id']; // Get the movie id from the URL
$movies->getMoviesById($movie_id);
$current_movie = $movies->getResult();

$data_country = null;

$current_country_id = $current_movie['country_id']; // Get the current movie's country_id

while ($row = $country->getResult()) {
  $selected = ($row['country_id'] == $current_country_id) ? 'selected' : '';
  $data_country .= '<option value="' . $row['country_id'] . '" ' . $selected . '>' . $row['country_name'] . '</option>';
}

$current_genres = explode(', ', $current_movie['movies_genre']);

$data_genre = null;

while ($row = $genre->getResult()) {
  $checked = in_array($row['genre_name'], $current_genres) ? 'checked' : '';
  $data_genre .= '<div class="form-check">
                  <input class="form-check-input" type="checkbox" name="movies_genre[]" id="genre' . $row['genre_id'] . '" value="' . $row['genre_name'] . '" ' . $checked . '>
                    <label class="form-check-label" for="genre' . $row['genre_id'] . '">
                      ' . $row['genre_name'] . '
                    </label>
                  </div>';
}

// If the form is submitted
if (isset($_POST['submit'])) {
    // If the movie data is successfully updated
    if ($movies->updateMovies($_POST, $movie_id) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'edit_movie.php?id=$movie_id';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'edit_movie.php?id=$movie_id';
            </script>";
    }
}

$form = '<form action="edit_movie.php?id=' . $current_movie['movies_id'] . '" method="post" enctype="multipart/form-data">
      <div class="col-md-6">
        <h3 class="mb-4">Edit Movie</h3>
        <input type="hidden" name="movies_id" value="' . $current_movie['movies_id'] . '">
        <input type="hidden" name="movies_image_old" value="' . $current_movie['movies_image'] . '">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="movies_title" id="title" value="' . $current_movie['movies_title'] . '">
        </div>
        <div class="form-group">
          <label for="director">Director</label>
          <input type="text" class="form-control" name="movies_director" id="director" value="' . $current_movie['movies_director'] . '">
        </div>
        <div class="form-group">
          <label for="cast">Cast</label>
          <input type="text" class="form-control" name="movies_cast" id="cast" value="' . $current_movie['movies_cast'] . '">
        </div>
        <div class="form-group">
          <label for="duration">Duration (minutes)</label>
          <input type="number" class="form-control" name="movies_duration" id="duration" value="' . $current_movie['movies_duration'] . '">
        </div>
        <div class="form-group">
          <label for="released year">Released year</label>
          <input type="number" class="form-control" name="movies_released_year" id="released year" value="' . $current_movie['movies_released_year'] . '">
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
          <textarea class="form-control" name="movies_synopsis" id="synopsis" rows="3">' . $current_movie['movies_synopsis'] . '</textarea>
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
$home->replace('DATA_COUNTRY', $data_country);
$home->replace('DATA_GENRE', $data_genre);
$home->write();
